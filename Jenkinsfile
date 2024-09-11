pipeline {
    agent any
    
    environment {
        SONARQUBE_URL = 'http://localhost:9000'
        SONARQUBE_CREDENTIALS = 'SonarQube'
        NEXUS_URL = 'http://localhost:8081'
        NEXUS_CREDENTIALS = 'nexus-credentials'
        DOCKER_REGISTRY = 'docker-hub-credentials'
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'dev', url: 'https://github.com/RhoumaInes/backoffice-e-commerce-symfony'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'vendor/bin/phpunit --log-junit build/logs/junit.xml --coverage-clover build/logs/clover.xml'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    // Assure-toi que tu as installé SonarScanner et configuré `sonar-project.properties`
                    sh 'sonar-scanner'
                }
            }
        }

        stage('Quality Gate') {
            steps {
                waitForQualityGate abortPipeline: true
            }
        }

        stage('Build Archive') {
            steps {
                sh 'zip -r build/my-app.zip . -x "*.git*" -x "build/*"'
            }
        }

        stage('Publish to Nexus') {
            steps {
                nexusArtifactUploader artifacts: [
                    [artifactId: 'my-app', classifier: '', file: 'build/my-app.zip', type: 'zip']
                ], credentialsId: "${env.NEXUS_CREDENTIALS}", groupId: 'com.mycompany.app', nexusUrl: "${env.NEXUS_URL}", repository: 'maven-releases', version: "${env.BUILD_ID}"
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("my-app:${env.BUILD_ID}")
                }
            }
        }

        stage('Push Docker Image') {
            steps {
                script {
                    docker.withRegistry('https://index.docker.io/v1/', "${env.DOCKER_REGISTRY}") {
                        docker.image("my-app:${env.BUILD_ID}").push()
                    }
                }
            }
        }
    }
    
    post {
        success {
            echo 'Pipeline success!'
        }
        failure {
            mail to: "ines.rhouma@esprit.tn",
            subject: "The Pipeline failed",
            body: "The Pipeline failed"
        }
    }
}
