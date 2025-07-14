#!/bin/bash

echo "🚀 Setting up Laravel Todo App..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install

# Setup environment
echo "⚙️ Setting up environment..."
cp .env.example .env
php artisan key:generate

# Setup database
echo "🗄️ Setting up database..."
touch database/database.sqlite
php artisan migrate

# Add sample data
echo "📊 Adding sample data..."
php artisan db:seed --class=TodoSeeder

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

echo "✅ Setup complete!"
echo ""
echo "🌟 To start the application:"
echo "   php artisan serve"
echo ""
echo "🌐 Then visit: http://localhost:8000"