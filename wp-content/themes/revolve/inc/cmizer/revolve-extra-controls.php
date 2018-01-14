<?php
    if(class_exists('WP_Customize_Control')) {
        /** Select Page Control **/
        class Revolve_WP_Customize_Select_Page_Control extends WP_Customize_Control {
            
            public function render_content() {
                $pages = $this->revolve_get_par_pagelist();
                
                if ( empty( $pages ) )
                return;
                
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <select <?php $this->link(); ?>>
                    <?php
                    foreach ( $pages as $value => $label )
                    echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html($label) . '</option>';
                    ?>
                    </select>
                </label>
                <?php
            }
            
            public function revolve_get_par_pagelist() {
                $pglist = array();
                $pglist[0] = 'Select Page';
                
                $pages = get_pages(array('parent' => 0));
                foreach($pages as $page) {
                    $pglist[$page->ID] = $page->post_title;
                }
                
                return $pglist;
            }
        }
        
        /** Select Single Category Control **/
        class Revolve_WP_Customize_Select_Single_Cat_Control extends WP_Customize_Control {
            public function render_content() {
                $cats = $this->revolve_get_catlist();
                $values = $this->value();
                
                if ( empty( $cats ) )
                return;
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <select <?php $this->link(); ?>>
                    <?php
                    foreach ( $cats as $id => $label )
                    echo '<option value="' . esc_attr( $id ) . '"' . selected( $this->value(), $id, false ) . '>' . esc_html($label) . '</option>';
                    ?>
                    </select>   
                </label>
                <?php
            }
            
            public function revolve_get_catlist() {
                $catlist = array();
                
                $catlist[0] = 'Select Category';
                $categories = get_categories( array('hide_empty' => 0) );
                
                foreach($categories as $cat){
                    $catlist[$cat->term_id] = $cat->name;
                }
                
                return $catlist;
            }
        }
        
        /** Exclude Multiple Category Control **/
        class Revolve_WP_Customize_Select_Mul_Cat_Control extends WP_Customize_Control {
            public function render_content() {
                $cats = $this->revolve_get_catlist();
                $values = $this->value();
                
                if ( empty( $cats ) )
                return;
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $this->label ) ) : ?>
                        <div id="ex-cat-wrap">
                            <?php $cat_arr = explode(',', $values); array_pop($cat_arr); $count = 1; ?>
                            
                            <?php foreach($cats as $id => $label) : ?>
                                <div class="chk-group <?php if($count++%2 == 0){echo "right";}else{echo "left";} ?>">
                                    <input id="ex-cat-<?php echo esc_attr($id); ?>" type="checkbox" value="<?php echo esc_attr($id); ?>" <?php if(in_array($id,$cat_arr)){ echo "checked"; }; ?> />
                                    <label for="ex-cat-<?php echo esc_attr($id); ?>"><?php echo esc_html($label); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                    <?php endif; ?>    
                </label>
                <?php
            }
            
            public function revolve_get_catlist() {
                $catlist = array();
                $categories = get_categories( array('hide_empty' => 0) );
                
                foreach($categories as $cat){
                    $catlist[$cat->term_id] = $cat->name;
                }
                
                return $catlist;
            }
        }
        
        /** Select Widget Control **/
        class Revolve_WP_Customize_Select_Widget_Control extends WP_Customize_Control {
            
            public function render_content() {
                $sidebars = $this->revolve_get_registered_sidebars();
                
                if ( empty( $sidebars ) )
                return;
                
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <select <?php $this->link(); ?>>
                    <?php
                    foreach ( $sidebars as $sidebar )
                    echo '<option value="' . esc_attr( $sidebar['id'] ) . '"' . selected( $this->value(), $sidebar['id'], false ) . '>' . esc_attr($sidebar['name']) . '</option>';
                    ?>
                    </select>
                </label>
                <?php
            }
            
            public function revolve_get_registered_sidebars() {
                $sidebars = array();
                
                $sidebars['sidebar-none'] = array('name' => 'Select Widget', 'id' => 0);
                $rsidebars = $GLOBALS['wp_registered_sidebars'];
                
                if(!empty($rsidebars)) {
                    foreach($rsidebars as $rsidebar) {
                        $sidebars[$rsidebar['id']] = array('name' => $rsidebar['name'], 'id' => $rsidebar['id']);
                    }
                }
                
                return $sidebars;
            }
        }
        
        /** Help Info Control **/
        class Revolve_WP_Customize_Help_Info_Control extends WP_Customize_Control {
            
            public function render_content() {
                $input_attrs = $this->input_attrs;
                $info = isset($input_attrs['info']) ? $input_attrs['info'] : '';
                ?>
                <div class="help-info">
                    <h4 class="help-info-title"><?php _e('Instruction', 'revolve'); ?></h4>
                    <div style="font-weight: bold;">
                        <?php echo wp_kses_post($info); ?>
                    </div>
                </div>
                <?php
            }
        }        
        
        /** Select Post Control **/
        class Revolve_WP_Customize_Select_Post_Control extends WP_Customize_Control {
            
            public function render_content() {
                $posts = $this->revolve_get_posts();
                
                if ( empty( $posts ) )
                return;
                
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <select <?php $this->link(); ?>>
                    <?php
                    foreach ( $posts as $id => $label )
                    echo '<option value="' . esc_attr($id) . '"' . selected( $this->value(), $id, false ) . '>' . esc_html($label) . '</option>';
                    ?>
                    </select>
                </label>
                <?php
            }
            
            public function revolve_get_posts() {
                $postlist = array();
                $postlist[0] = 'Select Post';
                
                $posts = get_posts();
                
                foreach($posts as $post) {
                    $postlist[$post->ID] = $post->post_title;
                }
                
                return $postlist;
            }
        }
    }