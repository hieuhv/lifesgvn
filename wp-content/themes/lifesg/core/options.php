<?php
if ( ! class_exists( 'LifeSG_Theme_Options' ) ) {
	
	class LifeSG_Theme_Options {
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;
		
		/* Load Redux Framework */
		public function __construct() {
			
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			
			// This is needed. Bah WordPress bugs.  <img draggable="false" class="emoji" alt="😉" src="https://s.w.org/images/core/emoji/2.2.1/svg/1f609.svg">
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}
		
		public function initSettings() {
 
			// Set the default arguments
			$this->setArguments();
		 
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();
		 
			// Create the sections and fields
			$this->setSections();
		 
			if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
		 
			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}
		
		public function setArguments() {
			$theme = wp_get_theme();
			$this->args = array(
				'opt_name'  => 'lifesg_options',
				'display_name' => $theme->get( 'Name' ),
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => __( 'LifeSG Options', 'lifesg' ),
				'page_title'         => __( 'LifeSG Options', 'lifesg' ),
				'dev_mode' => false,
				'customizer' => true,
				'menu_icon' => '',
				'google_api_key' => 'AIzaSyBjxJ1xJ2cgXpW7rZ-dVPeMtpo2Vy8a37U',
				'hints'              => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				) // end Hints
			);
		}
		
		/**
		Set up the Help area to guide the user
		**/
		public function setHelpTabs() {
		 
			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'lifesg' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'lifesg' )
			);
		 
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'lifesg' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'lifesg' )
			);
		 
			// Set the help sidebar
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'lifesg' );
		}
		
		public function setSections() {
 
			// Home Section
			$this->sections[] = array(
				'title'  => __( 'Header', 'lifesg' ),
				'desc'   => __( 'All of settings for header on this theme.', 'lifesg' ),
				'icon'   => 'el-icon-home',
				'fields' => array(
							array(
								'id'       => 'logo-on',
								'type'     => 'switch',
								'title'    => __( 'Enable Image Logo', 'lifesg' ),
								'compiler' => 'bool', // Return value true/false (boolean)
								'desc'     => __( 'Do you want to use image as a logo?', 'lifesg' ),
								'on' => __( 'Enabled', 'lifesg' ),
								'off' => __('Disabled')
							),
						 
							array(
								'id'       => 'logo-image',
								'type'     => 'media',
								'title'    => __( 'Logo Image', 'lifesg' ),
								'desc'     => __( 'Image that you want to use as logo', 'lifesg' ),
							),
							
							array(
								'id'       => 'header-banner',
								'type'     => 'media',
								'title'    => __( 'Header Banner', 'lifesg' ),
								'desc'     => __( 'Image that you want to use as header banner', 'lifesg' ),
							),
						)
			); // end section
			
			$this->sections[] = array(
				'title'  => __( 'Footer', 'lifesg' ),
				'desc'   => __( 'All of settings for header on this theme.', 'lifesg' ),
				'icon'   => 'el-icon-home',
				'fields' => array(						 
								array(
									'id'       => 'copyright-footer',
									'type'     => 'text',
									'title'    => __( 'Copyright', 'lifesg' ),
									'desc'     => __( 'Text for copyright', 'lifesg' ),
								),
						)
			); // end section
			
			// Typography Section
			$this->sections[] = array(
				'title' => __( 'Typography', 'thachpham' ),
				'desc' => __( 'All of settings for themes typography', 'lifesg' ),
				'icon' => 'el-icon-font',
				'fields' => array(
								// Main typography
								array(
									'id' => 'typo-main',
									'type' => 'typography',
									'title' => 'Main Typography',
									'output' => array( 'body' ),
									'text-transform' => true,
									'default' => array()
								),
							)
			); // end section
		 
		}
	}
	
	global $reduxConfig;
	$reduxConfig = new LifeSG_Theme_Options();
}