pipeline {
    agent any
    environment {
        VERSION = "1.0.${env.BUILD_NUMBER}"
        imagename = "inesrhouma/backoffice_symfony"
        DOCKER_CREDENTIALS_ID = "docker-hub-credentials"
        dockerImage = ''
        SONAR_TOKEN = credentials('sonar-token')  
        SONAR_HOST_URL = 'http://localhost:9000'
        SONAR_PROJECT_KEY = 'vr-marketplace'
    }
    stages {
        stage('Checkout') {
            steps {
                git branch: 'dev', url: 'https://github.com/RhoumaInes/backoffice-e-commerce-symfony'
            }
        }
        stage('Check Environment') {
            steps {
                bat 'php --version'
                bat 'composer --version'
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'composer --version'  
                bat 'rmdir /s /q vendor'
                bat 'del composer.lock'
                bat 'C:/ProgramData/ComposerSetup/bin/composer install --prefer-dist --optimize-autoloader' // Installer les dépendances
            }
        }
        
        stage('SonarQube Analysis') {
            steps {
                script {
                    bat "C:/ProgramData/ComposerSetup/bin/composer require --dev sonarsource/sonar-scanner-cli"
                    bat "C:/ProgramData/ComposerSetup/bin/composer exec sonar-scanner -Dsonar.projectKey=${SONAR_PROJECT_KEY} -Dsonar.host.url=${SONAR_HOST_URL} -Dsonar.login=${SONAR_TOKEN}"
                }
            }
        }

        stage('List Files') {
            steps {
                bat 'dir'
            }
        }
        stage('Building image') {
            steps{
                script {
                    dockerImage = docker.build("${imagename}:${BUILD_NUMBER}")
                }
            }
        }
        stage('Tagging Image') {
            steps {
                script {
                    bat "docker tag ${imagename}:${BUILD_NUMBER} inesrhouma/backoffice_symfony:${BUILD_NUMBER}"
                    bat "docker tag ${imagename}:${BUILD_NUMBER} inesrhouma/backoffice_symfony:latest"
                }
            }
        }
        stage('Deploy Image') {
            steps{
                script {
                    withDockerRegistry([credentialsId: DOCKER_CREDENTIALS_ID]) {
                        dockerImage.push("${BUILD_NUMBER}")
                        dockerImage.push('latest')
                    }
                }
            }
        }
        stage('Update Deployment YAML') {
            steps {
                script {
                    def deploymentYaml = readFile('deployment.yml')
                    deploymentYaml = deploymentYaml.replace('__IMAGE_NAME__', "${imagename}")
                    deploymentYaml = deploymentYaml.replace('__TAG__', "${BUILD_NUMBER}")
                    writeFile(file: 'deployment.yml', text: deploymentYaml)
                }
            }
        }

        stage('Remove Unused docker image') {
            steps{
                bat "docker rmi ${imagename}:${BUILD_NUMBER}"
                bat "docker rmi ${imagename}:latest"
            }
        }
    }    
    post {
        failure {
            mail to: "ines.rhouma@esprit.tn",
            subject: "The Pipeline failed",
            body: "The Pipeline failed"
        }
    }
}
