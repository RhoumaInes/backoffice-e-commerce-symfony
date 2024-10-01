pipeline {
    agent any
    environment {
        VERSION = "1.0.${env.BUILD_NUMBER}"
        imagename = "backoffice_app_symfony"
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

        stage('Building image') {
            steps {
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
        stage('Login to Docker Hub') {
            steps {
                script {
                    withDockerRegistry([credentialsId: DOCKER_CREDENTIALS_ID]) {
                        echo "Logged in to Docker Hub"
                    }
                }
            }
        }
        stage('Deploy Image') {
            steps {
                script {
                    withDockerRegistry([credentialsId: DOCKER_CREDENTIALS_ID]) {
                        dockerImage.push("${BUILD_NUMBER}")
                        dockerImage.push('latest')
                    }
                }
            }
        }
        stage('Remove Unused Docker Image') {
            steps {
                bat "docker rmi ${imagename}:${BUILD_NUMBER}"
                bat "docker rmi ${imagename}:latest"
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
            subject: "The Pipeline failed for build #${BUILD_NUMBER}",
            body: "The Pipeline failed for build #${BUILD_NUMBER}. Check Jenkins for details: ${env.BUILD_URL}"
        }
    }
}
