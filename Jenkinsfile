pipeline {
    agent any

    environment {
        DOCKER_COMPOSE_FILE = 'docker-compose.yml'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build and Start Docker Containers') {
            steps {
                bat 'docker-compose down || exit 0'
                bat 'docker-compose up -d --build'
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'docker exec laravel_app composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Run Tests') {
            steps {
                bat 'docker exec laravel_app php artisan config:cache'
                bat 'docker exec laravel_app php artisan migrate --env=testing --force'
                bat 'docker exec laravel_app ./vendor/bin/phpunit'
            }
        }

        stage('Stop and Remove Containers') {
            steps {
                bat 'docker-compose down'
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '**/storage/logs/*.log', allowEmptyArchive: true
        }
    }
}
