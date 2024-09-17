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

    }

    
}
