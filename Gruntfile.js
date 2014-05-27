module.exports = function(grunt) {

	// Project configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		banner:
			'/**\n' +
			' * <%= pkg.name %> <%= pkg.version %>\n' +
			' * By <%= pkg.author %>\n' +
			' *    <%= pkg.authorEmail %>\n' +
			' */\n',

		clean: {
			build: [
				'build'
			],
			packages: [
				'source/packages/bootstrap/docs',
				'source/packages/bootstrap/fonts',
				'source/packages/bootstrap/grunt',
				'source/packages/bootstrap/js',
				'source/packages/bootstrap/test-infra',
				'source/packages/bootstrap/_config.yml',
				'source/packages/bootstrap/.editorconfig',
				'source/packages/bootstrap/.gitattributes',
				'source/packages/bootstrap/.gitignore',
				'source/packages/bootstrap/.travis.yml',
				'source/packages/bootstrap/bower.json',
				'source/packages/bootstrap/CNAME',
				'source/packages/bootstrap/composer.json',
				'source/packages/bootstrap/CONTRIBUTING.md',
				'source/packages/bootstrap/Gruntfile.js',
				'source/packages/bootstrap/package.json',
				'source/packages/bootstrap/README.md',
				'source/packages/ratchet/docs',
				'source/packages/ratchet/fonts',
				'source/packages/ratchet/grunt',
				'source/packages/ratchet/js',
				'source/packages/ratchet/_config.yml',
				'source/packages/ratchet/.gitattributes',
				'source/packages/ratchet/.gitignore',
				'source/packages/ratchet/.travis.yml',
				'source/packages/ratchet/bower.json',
				'source/packages/ratchet/CNAME',
				'source/packages/ratchet/CONTRIBUTING.md',
				'source/packages/ratchet/Gruntfile.js',
				'source/packages/ratchet/package.json',
				'source/packages/ratchet/README.md',
				'source/packages/codeigniter/.gitignore',
				'source/packages/codeigniter/.travis.yml'
			]
		},

		concat: {
			options: {
				banner: '<%= banner %>'
			}
		},

		copy: {
			build: {
				files: [{
					expand: true,
					cwd: 'source/',
					src: [
						'.htaccess',
						'favicon.ico',
						'application/**',
						'resources/**'
					],
					dest: 'build/'
				}, {
					expand: true,
					cwd: 'source/',
					src: [
						'fonts/**',
						'img/**',
						'js/**',
						'svg/**'
					],
					dest: 'build/resources/'
				}]
			},
			docs: {
				files: {
					expand: true,
					cwd: 'source/docs',
					src: '**',
					dest: 'build/docs/'
				}
			},
			packages: {
				files: [{
					expand: true,
					cwd: 'source/packages/bootstrap/dist/',
					src: '**',
					dest: 'build/resources/'
				}, {
					expand: true,
					cwd: 'source/packages/ratchet/dist/',
					src: '**',
					dest: 'build/resources/'
				}, {
					expand: true,
					cwd: 'source/packages/codeigniter/',
					src: '**',
					dest: 'build/'
				}]
			}
		},

		less: {
			options: {
				outputSourceFiles: true
			},
			build: {
				options: {
					sourceMap: true,
					sourceMapURL: '<%= pkg.name.toLowerCase() %>-theme.css.map',
					sourceMapFilename: 'build/resources/css/<%= pkg.name.toLowerCase() %>-theme.css.map'
				},
				files: [{
					'build/resources/css/<%= pkg.name.toLowerCase() %>-theme.css': 'source/less/theme.less'
				}, {
					expand: true,
					cwd: 'source/less/',
					src: 'theme-*.less',
					dest: 'build/resources/css/',
					ext: '.css',
					rename: function(dest, src) {
						var path = require('path');
						var pkg_name = '<%= pkg.name.toLowerCase() %>';

						return path.join(dest, pkg_name + '-' + path.basename(src));
					}
				}]
			},
			minify: {
				options: {
					cleancss: true
				},
				files: [{
					'build/resources/css/<%= pkg.name.toLowerCase() %>-theme.min.css': 'build/resources/css/<%= pkg.name.toLowerCase() %>-theme.css'
				}, {
					expand: true,
					cwd: 'source/less/',
					src: 'theme-*.less',
					dest: 'build/resources/css/',
					ext: '.min.css',
					rename: function(dest, src) {
						var path = require('path');
						var pkg_name = '<%= pkg.name.toLowerCase() %>';

						return path.join(dest, pkg_name + '-' + path.basename(src));
					}
				}]
			}
		},

		uglify: {
			options: {
				banner: '<% banner %>'
			},
			build: {
				src: 'build/resources/js/<%= pkg.name.toLowerCase() %>.js',
				dest: 'build/resources/js/<%= pkg.name.toLowerCase() %>.min.js'
			}
		},

		usebanner: {
			options: {
				position: 'top',
				banner: '<%= banner %>'
			},
			files: {
				src: [
					'build/resources/css/<%= pkg.name.toLowerCase() %>-theme*.css'
				]
			}
		},

		watch: {
			less: {
				files: 'source/less/*.less',
				tasks: [
					'less:build',
					'less:minify'
				]
			}
		}

	});

	// Load the plugins that provides the tasks
	grunt.loadNpmTasks('grunt-banner');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default tasks
	grunt.registerTask('default', [
		'clean:packages',
		'clean:build',
		'copy:packages',
		'copy:build',
		'less:build',
		'less:minify',
		'uglify:build',
		'usebanner'
	]);

	// Reset tasks
	grunt.registerTask('reset', [
		'clean:packages',
		'clean:build'
	]);

};