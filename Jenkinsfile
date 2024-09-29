pipeline {
    agent any
    environment {
        VERSION = "1.0.${env.BUILD_NUMBER}"
        imagename = "inesrhouma/backoffice_symfony"
        DOCKER_CREDENTIALS_ID = "docker-hub-credentials"
        dockerImage = ''
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
                // Vérifier et installer les dépendances Composer
                bat 'composer --version'  // Vérifie la version de Composer
                bat 'rmdir /s /q vendor'
                bat 'del composer.lock'
                bat 'C:/ProgramData/ComposerSetup/bin/composer install --prefer-dist --optimize-autoloader' // Installer les dépendances
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
                    dockerImage = docker.build("${IMAGE_NAME}:${BUILD_NUMBER}")
                }
            }
        }
        stage('Deploy Image') {
            steps{
                script {
                    withDockerRegistry([credentialsId: DOCKER_CREDENTIALS_ID]) {
                        dockerImage.push("$BUILD_NUMBER")
                        dockerImage.push('latest')
                    }
                }
            }
        }
        stage('Remove Unused docker image') {
            steps{
                bat "docker rmi $imagename:$BUILD_NUMBER"
                bat "docker rmi $imagename:latest"
        
            }
        }
        
        stage('Deploy to Kubernetes') {
            steps {
                script {
                    bat "kubectl apply -f deployment.yml"
                }
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