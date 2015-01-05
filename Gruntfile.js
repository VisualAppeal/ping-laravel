module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		chmod: {
			options: {
				mode: '777'
			},
			storage: {
				src: [
					'app/storage/cache',
					'app/storage/logs',
					'app/storage/meta',
					'app/storage/sessions',
					'app/storage/views',
				]
			}
		},
		less: {
			main: {
				options: {
					paths: ['public/less']
				},
				files: {
					'public/css/main.min.css': 'public/less/main.less'
				}
			}
		},
		uglify: {
			options: {
				sourceMap: true
			},
			app: {
				files: {
					'public/js/main.min.js': [
						'public/js/main.js'
					]
				}
			}
		},
		shell: {
			install: {
				command: [
						'php artisan migrate --package=cartalyst/sentry',
						'php artisan migrate',
						'php artisan db:seed --class="InstallSeeder"'
				].join(' && ')
			},
			seed: {
				command: 'php artisan db:seed --class=DevelopmentSeeder'
			}
		}
	});

	grunt.loadNpmTasks('grunt-chmod');
	grunt.loadNpmTasks('grunt-shell');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');

	grunt.registerTask('install', ['chmod', 'shell:install']);
	grunt.registerTask('seed', ['shell:seed']);
	grunt.registerTask('build', ['less', 'uglify']);
	grunt.registerTask('default', ['build']);
};
