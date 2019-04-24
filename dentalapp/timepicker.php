<?php 
function get_times( $default = '09:00', $interval = '+30 minutes' ) {
                $output = '';            
                $current = strtotime( '09:00' );
                $end = strtotime( '16:59' );
            
                while( $current <= $end) {
                    //fill the dropdown with half hour intervals between 9AM and 5PM
                    $time = date( 'H:i', $current );
                    $sel = ( $time == $default ) ? ' selected' : '';           
                    $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
                    $current = strtotime( $interval, $current );
               
                }           
                return $output;
            }
?>