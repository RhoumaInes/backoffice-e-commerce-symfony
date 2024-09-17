pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'dev', url: 'https://github.com/RhoumaInes/backoffice-e-commerce-symfony'
            }
        }

        stage('Build') {
            steps {
                parallel(
                    composer: {
                        sh 'composer install --prefer-dist --optimize-autoloader'
                        sh 'composer require --dev phpmetrics/phpmetrics friendsofphp/php-cs-fixer --no-interaction --prefer-dist --optimize-autoloader'
                    },
                    'prepare-dir': {
                        sh 'rm -Rf ./build/'
                        sh 'mkdir -p ./build/coverage'
                        sh 'mkdir -p ./build/logs'
                        sh 'mkdir -p ./build/phpmetrics'
                    }
                )
            }
        }


        stage('Linter & Test') {
            steps {
                parallel(
                    'cache-clear prod': {
                        sh 'APP_ENV=prod ./bin/console cache:clear'
                    },
                    'php-lint': {
                        sh 'php -l src/'
                    },
                    'symfony-container': {
                        sh './bin/console lint:container'
                    },
                    'symfony-yaml': {
                        sh './bin/console lint:yaml config/ src/ --parse-tags'
                    },
                    'doctrine-mapping': {
                        sh './bin/console doctrine:schema:validate --skip-sync'
                    },
                    phpunit: {
                        sh 'vendor/bin/phpunit --configuration ./phpunit.xml --log-junit ./build/logs/phpunit.junit.xml --coverage-html ./build/coverage --coverage-cobertura ./build/logs/coverage.corbutera.xml'
                    },
                    /*behat: {},*/
                    failFast: true
                )
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
