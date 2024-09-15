pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'dev', url: 'https://github.com/RhoumaInes/backoffice-e-commerce-symfony'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Vérifier et installer les dépendances Composer
                sh 'which composer'  // Vérifie où Composer est installé
                sh 'composer --version'  // Vérifie la version de Composer
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'  // Installer les dépendances
            }
        }

        stage('Run Tests') {
            steps {
                // Exécuter les tests PHPUnit
                sh './vendor/bin/phpunit --log-junit test-results.xml'
            }
            post {
                always {
                    // Archive les résultats des tests dans Jenkins
                    junit 'test-results.xml'
                }
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('My SonarQube Server') {
                    bat 'sonar-scanner'
                }
            }
        }

        stage('Quality Gate') {
            steps {
                timeout(time: 1, unit: 'HOURS') {
                    waitForQualityGate abortPipeline: true
                }
            }
        }

        stage('Build Archive') {
            steps {
                bat 'zip -r archive.zip *'
            }
        }

        stage('Publish to Nexus') {
            steps {
                bat 'curl -v -u admin:nexus --upload-file archive.zip http://nexus.example.com/repository/my-repo/'
            }
        }
    }

    
}
