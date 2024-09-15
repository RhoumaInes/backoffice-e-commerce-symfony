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
                // Use 'start /b' instead of nohup on Windows
                bat 'composer install'
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

    post {
        success {
            mail to: 'ines.rhouma@esprit.tn', subject: 'Build Successful', body: 'The build was successful.'
        }
        failure {
            mail to: 'ines.rhouma@esprit.tn', subject: 'Build Failed', body: 'The build failed. Check Jenkins for details.'
        }
    }
}
