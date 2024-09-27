<?php
namespace Deployer;

require 'recipe/wordpress.php';

// Config

// Set the repository URL where your WordPress project is hosted.
set('repository', 'git@github.com:AdvenAdam/wp-triconville.git');

// Set shared files and directories
// Common shared directories for WordPress: 'wp-content/uploads', etc.
add('shared_files', ['wp-config.php']); // Example, modify as needed
add('shared_dirs', ['wp-content/uploads']);
add('writable_dirs', ['wp-content/uploads']);

// Hosts Configuration

host('34.124.194.147')
    ->set('remote_user', 'Dev04') // Make sure 'deployer' user has SSH access and the correct permissions
    ->set('deploy_path', '/var/www/wp-triconville') // Path where the WordPress project will be deployed
    ->set('branch', 'main') // Specify the branch to deploy, adjust as needed
    ->set('http_user', 'www-data') // Ensures correct user for writable files
    ->set('writable_mode', 'chmod') // Set writable mode for directories
    ->set('writable_use_sudo', true); // Use sudo if writable permission issues occur

// Hooks

// Automatically unlock after a failed deployment
after('deploy:failed', 'deploy:unlock');

// Clear cache after successful deployment
after('deploy:success', 'deploy:cleanup');