module.exports = function(grunt){
//	
//	//configure grunt
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		//check js syntax and basic testing
		jshint: {
			options: {
				reporter: require('jshint-stylish')
			},
			build: ['Gruntfile.js', 'app/src/**/*.js']
		},
		//gather and minifiy js files
		uglify: {
			options: {
				banner: '/*\n <% pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
			},
			build: {
				files: {
					'app/dist/app.min.js': 'app/src/js/**/*.js'
				}
			}
		},
		//compile sass files to css
		compass: {
			dist: {
				options: {
					sassDir: 'app/src/css',
					cssDir: 'app/src/css'
				}
			},
			dev: {
				options: {
					sassDir: 'app/src/css',
					cssDir: 'app/src/css'
				}
			}
		},
		//gather and minify css files
		cssmin: {
			options: {
				banner: '/*\n <% pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
			},
			build: {
				files: {
					'app/dist/app.min.css': 'app/src/css/**/*.css'
				}
			}
		},
		//configure watch to autoupdate
		watch: {
			css: {
				files: ['app/src/css/**/*.scss'],
				tasks: ['compass', 'cssmin']
			},
			scripts: {
				files: ['app/src/js/**/*.js'],
				tasks: ['jshint','uglify']
			}
		}
	});

	//load grunt plugins
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	
	grunt.registerTask('default', ['jshint','uglify','compass','cssmin']);
};