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
        // Remplacement dynamique du tag dans le fichier deployment.yml
        stage('Update Deployment YAML') {
            steps {
                script {
                    // Remplacement du tag et du nom d'image dans le fichier deployment.yml
                    def deploymentYaml = readFile('deployment.yml')
                    deploymentYaml = deploymentYaml.replace('__IMAGE_NAME__', "${imagename}")
                    deploymentYaml = deploymentYaml.replace('__TAG__', "${BUILD_NUMBER}")
                    writeFile(file: 'deployment.yml', text: deploymentYaml)
                }
            }
        }

        stage('Deploy to Kubernetes') {
            steps {
                script {
                    // Démarre minikube si nécessaire (si tu utilises minikube)
                    bat "minikube start"

                    // Applique la configuration du déploiement avec le bon tag
                    bat "kubectl apply -f deployment.yml"

                    // Vérifie que les pods sont en cours d'exécution
                    bat "kubectl get pods"
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