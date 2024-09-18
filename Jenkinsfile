pipeline {
    agent any

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

        stage('Deploy to Nexus') {
            steps {
                script {
                    def nexusUrl = 'http://localhost:8081'
                    def repository = 'symfony-artifacts'
                    def fileName = 'my-artifact.zip'
                    
                    sh "curl -v -u admin:nexus --upload-file ${fileName} ${nexusUrl}/#admin/repository/${repository}/${fileName}"
                }
            }
        }
    }

    
}