<?php
    	if ( is_user_logged_in() ) {
		


            // Checking and validating when products are added to cart 
            add_filter( 'woocommerce_add_to_cart_validation', 'only_six_items_allowed_add_to_cart', 10, 3 );
            
            function only_six_items_allowed_add_to_cart( $passed, $product_id, $quantity ) {
                $user_ID= get_current_user_id();
                $stock = get_user_meta($user_ID,'wpcf-shirt-quantity',true);
            
                $field = $stock;
                
                $user_qty = $field;
                $cart_items_count = WC()->cart->get_cart_contents_count();
                $total_count = $cart_items_count + $quantity;
            
                if( $cart_items_count >= $user_qty || $total_count > $user_qty ){
                    // Set to false
                    $passed = false;
                    // Display a message
                     wc_add_notice( __( "You can’t have more than $user_qty items in cart", "woocommerce" ), "error" );
                }
                return $passed;
            }
            
            // Checking and validating when updating cart item quantities when products are added to cart
            add_filter( 'woocommerce_update_cart_validation', 'only_six_items_allowed_cart_update', 10, 4 );
            function only_six_items_allowed_cart_update( $passed, $cart_item_key, $values, $updated_quantity ) {	
            
                $user_ID= get_current_user_id();
                $stock = get_user_meta($user_ID,'wpcf-shirt-quantity',true);
                
                $field = $stock;
            
                $user_qty = $field;
                $cart_items_count = WC()->cart->get_cart_contents_count();
                $original_quantity = $values['quantity'];
                $total_count = $cart_items_count - $original_quantity + $updated_quantity;
            
                if( $cart_items_count > $user_qty || $total_count > $user_qty ){
                    // Set to false
                    $passed = false;
                    // Display a message
                     wc_add_notice( __( "You can’t have more than $user_qty items in cart", "woocommerce" ), "error" );
                }
                return $passed;
            }
                    
            };
            
            


?>