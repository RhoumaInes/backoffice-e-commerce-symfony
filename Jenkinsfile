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

        stage('Run Tests') {
            steps {
                // Exécuter les tests PHPUnit
                bat 'vendor\\bin\\phpunit --log-junit test-results.xml'
            }
            post {
                always {
                    // Archive les résultats des tests dans Jenkins
                    junit '**/test-results.xml'
                }
            }
        }
        stage('SonarQube analysis') {
            environment {
                scannerHome = tool 'SonarQube Scanner'
            }
            steps {
                withSonarQubeEnv('SonarQube') {
                    bat "${scannerHome}/bin/sonar-scanner"
                }
            }
        }
        stage('Create Zip Artifact') {
            steps {
                script {
                    // Créer un fichier .zip de votre projet Symfony
                    def zipFileName = "my-artifact-${env.VERSION}.zip"
                    bat "\"C:\\Program Files\\7-Zip\\7z.exe\" a ${zipFileName} .\\*"
                }
            }
        }
        stage('Deploy to Nexus') {
            steps {
                script {
                    def nexusUrl = 'http://localhost:8081'
                    def repository = 'symfony-artifacts'
                    def fileName = "my-artifact-${env.VERSION}.zip"
                    
                    bat "curl -v -u admin:nexus --upload-file ${fileName} ${nexusUrl}/repository/${repository}/${fileName}"
                }
            }
        }

        stage('Building image') {
            steps{
                script {
                    dockerImage = docker.build("backoffice_symfony:${BUILD_NUMBER}")
                }
            }
        }
        stage('Deploy Image') {
            steps{
                script {
                    withDockerRegistry(credentialsId: DOCKER_CREDENTIALS_ID) {
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