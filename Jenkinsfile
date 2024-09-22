pipeline {
    agent any
    environment {
        VERSION = "1.0.${env.BUILD_NUMBER}"
        DOCKER_IMAGE = "inesrhouma/backoffice-symfony:latest"
        DOCKER_CREDENTIALS_ID = "docker-hub-credentials"
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
                    bat "powershell Compress-Archive -Path .\\* -DestinationPath ${zipFileName}"
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
        stage('Build Docker Image') {
            steps {
                script {
                    bat "docker build -t ${env.DOCKER_IMAGE} ."
                }
            }
        }
        stage('Push Docker Image to Docker Hub') {
            steps {
                timeout(time: 10, unit: 'MINUTES') {
                    script {
                            withCredentials([usernamePassword(credentialsId: "${env.DOCKER_CREDENTIALS_ID}", passwordVariable: 'DOCKER_PASSWORD', usernameVariable: 'DOCKER_USERNAME')]) {
                            bat "docker login -u ${DOCKER_USERNAME} -p ${DOCKER_PASSWORD}"
                            bat "docker push ${env.DOCKER_IMAGE}"
                        }
                    }
                }
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
}