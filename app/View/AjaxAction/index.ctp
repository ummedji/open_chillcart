<?php 
    switch ($Action) {
        case 'HeaderCount':
    
            if (is_array($orders)):
                $orders = array_slice($orders,0,5);
    ?>
                <div class="row">
    <?php
                foreach ($orders as $nKey => $nValue):
    ?>
                        <div class="col-sm-12">
        	        		<div class="col-sm-4">
        	        		<?php echo $nValue['Order']['order_date'].' '.$nValue['Order']['order_time'] ?>
        	        		</div>
        	        		<div class="col-sm-4">
        	        		<?php echo $nValue['Order']['custom_order_id'] ?>
        	        		</div>
        	        		<div class="col-sm-4">
        	        		<?php echo stripslashes($nValue['Restaurant']['restaurant_name']) ?>
        	        		</div>
        	        	</div>
    <?php 
                endforeach;
    ?>
                </div>
    <?php
                echo '||@@||'.count($newOrders);
                $_SESSION['NewOrderCount'] = $newOrderCount;
            endif; 
        break;
        
        case 'TrackingOrder':
        
            echo $this->GoogleMap->map();
            
?>
            <div id="mapIcons"> <input id="trackId" type="hidden" value="<?php echo $orders[0]['Order']['id'] ?>">
<?php            
            
            $customerLatitude   = (isset($orders[0]['Order']['delivery_latitude'])) ? $orders[0]['Order']['delivery_latitude'] : '';
            $customerLongitude  = (isset($orders[0]['Order']['delivery_longitude'])) ? $orders[0]['Order']['delivery_longitude'] : '';
            
            $restaurantLatitude = (isset($orders[0]['Restaurant']['latitude'])) ? $orders[0]['Restaurant']['latitude'] : '';
            $restaurantLongitude = (isset($orders[0]['Restaurant']['longitude'])) ? $orders[0]['Restaurant']['longitude'] : '';
            
            #Customer
            echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$customerLatitude, 'longitude'=>$customerLongitude),array (
                    'markerIcon' => $siteUrl.'images/customer.png',
                    'windowText' => $orders[0]['Order']['customer_name'].'</br>'.$orders[0]['Order']['custom_order_id'].'</br>'.$orders[0]['Order']['order_date'].' '.$orders[0]['Order']['order_time'].'</br>'.html_entity_decode($this->Number->currency($orders[0]['Order']['total'],$siteCurrency))
                  )); 
            
            #Restaurant
            
            #if ($orders[0]['Statuses']['status'] != 'Picked up' && $orders[0]['Statuses']['status'] != 'On the way') {
                echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$restaurantLatitude, 'longitude'=>$restaurantLongitude),array (
                    'markerIcon' => $siteUrl.'images/restaurant.png',
                    'windowText' => stripslashes($orders[0]['Restaurant']['restaurant_name'])
                  ));
            #}
            
        
            if (isset($drivers)) {
                #Drivers      
                foreach ($drivers as $k => $v) {
                    echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$drivers[$k]['Drivertracking']['latitude'], 'longitude'=>$drivers[$k]['Drivertracking']['longitude']),array (
                        'markerIcon' => $siteUrl.'images/'.str_replace(' ','',strtolower($orders[0]['Statuses']['status'])).'.png',
                        'windowText' => $v['User']['firstname'].' '.$v['User']['name']
                      ));
                }
                 
            } else {
                echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$orders[0]['User']['Driver']['Drivertracking']['latitude'], 'longitude'=>$orders[0]['User']['Driver']['Drivertracking']['longitude']),array (
                    'markerIcon' => $siteUrl.'images/'.str_replace(' ','',strtolower($orders[0]['Statuses']['status'])).'.png',
                    'windowText' => $orders[0]['User']['firstname'].'</br>'.$orders[0]['Order']['custom_order_id'].'</br>'.$orders[0]['Order']['order_date'].' '.$orders[0]['Order']['order_time']
                  )); 
                  
                #Driver Direction
                if ($orders[0]['Statuses']['status'] == 'Accepted') {
                    echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                        "from" => array("latitude" => $orders[0]['User']['Driver']['Drivertracking']['latitude'], "longitude" => $orders[0]['User']['Driver']['Drivertracking']['longitude']),
                        "to"   => array("latitude" => $restaurantLatitude, "longitude" => $restaurantLongitude)
                      ));
                } elseif ($orders[0]['Statuses']['status'] == 'Picked up' || $orders[0]['Statuses']['status'] == 'On the way') {
                    echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                        "from" => array("latitude" => $orders[0]['User']['Driver']['Drivertracking']['latitude'], "longitude" => $orders[0]['User']['Driver']['Drivertracking']['longitude']),
                        "to"   => array("latitude" => $customerLatitude, "longitude" => $customerLongitude)
                      ));
                }
            }
            
            if ($orders['Order']['status'] != 'Delivered'):
?>
            <script>
            var trackId = $('#trackId').val();
                setTimeout(function() {
                    $.post(rp+'AjaxAction',{'OrderId':trackId,'Action':'LoadTrackingMap'}, function(response) {
                        deleteMarkers();
                        <?php if ($orders['Order']['status'] != 'Accepted'): ?>
                            directions1Display.setMap(null);
                            directions1Display.setPanel(null);
                        <?php endif; ?>
                        $('#mapIcons').html(response);
                        clearConsole();
                        return false;
                    });
                }, 5000);
            </script>
<?php
            endif;
?>
            </div>
<?php            
        break;
        
        case 'LoadTrackingMap':
        
            //echo "<pre>"; print_r($orders);
                                    
            $customerLatitude   = (isset($orders['Order']['destination_latitude'])) ? $orders['Order']['destination_latitude'] : '';
            $customerLongitude  = (isset($orders['Order']['destination_longitude'])) ? $orders['Order']['destination_longitude'] : '';
            
            $storeLatitude = (isset($orders['Order']['source_latitude'])) ? $orders['Order']['source_latitude'] : '';
            $storeLongitude = (isset($orders['Order']['source_longitude'])) ? $orders['Order']['source_longitude'] : '';
            
            #Customer
            echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$customerLatitude, 'longitude'=>$customerLongitude),array(
                    'markerIcon' => $siteUrl.'/images/customer.png',
                    'windowText' => $orders['Order']['customer_name'].'</br>'.$orders['Order']['ref_number'].'</br>'.$orders['Order']['delivery_date'].' '.$orders['Order']['created'].'</br>'.html_entity_decode($this->Number->currency($orders['Order']['order_grand_total'],$siteCurrency))
                  )); 
            
            #store
            
            #if ($orders['Statuses']['status'] != 'Picked up' && $orders['Statuses']['status'] != 'On the way') {
                echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$storeLatitude, 'longitude'=>$storeLongitude),array(
                    'markerIcon' => $siteUrl.'/images/store.png',
                    'windowText' => stripslashes($orders['Store']['store_name'])
                  ));
            #}
            
        
            if (isset($drivers)) {
                #Drivers      
                foreach ($drivers as $k => $v) {
                    echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$drivers[$k]['DriverTracking']['driver_latitude'], 'longitude'=>$drivers[$k]['DriverTracking']['driver_longitude']),array(
                        'markerIcon' => $siteUrl.'/images/'.str_replace(' ','',strtolower($orders['Order']['status'])).'.png',
                        'windowText' => $v['Driver']['driver_name']
                      ));
                }
                echo '||@@||';
            } else {
                echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$Driver['DriverTracking']['driver_latitude'], 'longitude'=>$Driver['DriverTracking']['driver_longitude']),array(
                    'markerIcon' => $siteUrl.'/images/'.str_replace(' ','',strtolower($orders['Order']['status'])).'.png',
                    'windowText' => $Driver['Driver']['driver_name'].'</br>'.$orders['Order']['ref_number'].'</br>'.$orders['Order']['delivery_date'].' '.$orders['Order']['created']
                  )); 
                  
                #Driver Direction
                if ($orders['Order']['status'] == 'Driver Accepted') {
                    echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                        "from" => array("latitude" => $Driver['DriverTracking']['driver_latitude'], "longitude" => $Driver['DriverTracking']['driver_longitude']),
                        "to"   => array("latitude" => $storeLatitude, "longitude" => $storeLongitude)
                      ));
                    echo "<input type='hidden' name='direction' value='available'>";
                    echo '||@@||';
?>
                    <span>Aproximate Distance To Restaurant : <?php echo $orders['distance']['distanceText']; ?></span>
                    <span>Aproximate Time To Restaurant : <?php echo $orders['distance']['durationText'] ?></span>
<?php
                } elseif ($orders['Order']['status'] == 'Collected') {
                    echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                        "from" => array("latitude" => $Driver['DriverTracking']['driver_latitude'], "longitude" => $Driver['DriverTracking']['driver_longitude']),
                        "to"   => array("latitude" => $customerLatitude, "longitude" => $customerLongitude)
                      ));
                    echo "<input type='hidden' name='direction' value='available'>";
                    echo '||@@||';
?>
                    <span>Aproximate Distance To Customer : <?php echo $orders['distance']['distanceText']; ?></span>
                    <span>Aproximate Time To Customer : <?php echo $orders['distance']['durationText'] ?></span>
<?php
                } elseif ($orders['Order']['status'] == 'Delivered') {
                    echo '||@@||';
                    echo 'This order was completed by '.$Driver['Driver']['driver_name'];
                }
            }
            
            
        break;
        
        case 'LoadDashboardMap':
            
            $rest = array();
            
            #Available Drivers
            if (is_array($drivers)):
                foreach ($drivers as $val):
                    $dLatitude  = $val['Drivertracking']['latitude'];
                    $dLongitude = $val['Drivertracking']['longitude'];
                    if ($dLatitude != '' && $dLongitude != ''):
                        echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$dLatitude, 'longitude'=>$dLongitude),array (
                            'markerIcon' => $siteName.'/images/new.png',
                            'windowText' => $val['User']['firstname'].'</br>'.$val['Vehicle']['vehicle_name'].' '.$val['Vehicle']['model_name']
                          ));
                    endif;
                endforeach;
            endif;
             
            if (is_array($orders)) {
                                               
                foreach ($orders as $key=>$value) {
                    
                    $rest[$orders[$key]['Restaurant']['id']] .= ($value['Statuses']['status'] != 'Delivered') ? '<br/><br/>'.$value['Order']['custom_order_id'].'</br>'.$value['Order']['order_date'].' '.$value['Order']['order_time'] : '';
                    
                    
                    $deliveryLatitude       = (isset($value['Order']['delivery_latitude'])) ? $value['Order']['delivery_latitude'] : '';
                    $deliveryLongitude      = (isset($value['Order']['delivery_longitude'])) ? $value['Order']['delivery_longitude'] : '';
                    
                    $restaurantLatitude     = (isset($value['Restaurant']['latitude'])) ? $value['Restaurant']['latitude'] : '';
                    $restaurantLongitude    = (isset($value['Restaurant']['longitude'])) ? $value['Restaurant']['longitude'] : '';
                    
                    $driverLatitude         = (isset($value['User']['Driver']['Drivertracking']['latitude'])) ? $value['User']['Driver']['Drivertracking']['latitude'] : '';
                    $driverLongitude        = (isset($value['User']['Driver']['Drivertracking']['longitude'])) ? $value['User']['Driver']['Drivertracking']['longitude'] : '';
                    
                    if ($value['Statuses']['status'] != 'Delivered') {
                        
                        #Customer
                        if ($deliveryLatitude != '' && $deliveryLongitude != '') {
                            echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$deliveryLatitude, 'longitude'=>$deliveryLongitude),array (
                                'markerIcon' => $siteUrl.'images/customer.png',
                                'windowText' => $value['Order']['custom_order_id'].'</br>'.$value['Order']['order_date'].' '.$value['Order']['order_time'].'</br>'.html_entity_decode($this->Number->currency($value['Order']['total'],$siteCurrency))
                              ));
                        }
                         
                        
                        #Restaurant
                        if ($restaurantLatitude != '' && $restaurantLongitude != '') {
                            echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$restaurantLatitude, 'longitude'=>$restaurantLongitude),array (
                                'markerIcon' => $siteUrl.'images/restaurant.png',
                                'windowText' => stripslashes($value['Restaurant']['restaurant_name']).$rest[$value['Restaurant']['id']]
                              ));
                        }
                        
                        
                        #Drivers  
                        if ($driverLatitude != '' && $driverLongitude != '') {
                            echo $this->GoogleMap->addMarker("map_canvas", 1, array('latitude'=>$driverLatitude, 'longitude'=>$driverLongitude),array (
                                'markerIcon' => $siteUrl.'images/'.str_replace(' ','',strtolower($value['Statuses']['status'])).'.png',
                                'windowText' => $value['Order']['custom_order_id'].'</br>'.$value['Order']['order_date'].' '.$value['Order']['order_time']
                              ));
                        }    
                         
                        
                        #Directions                        
                        /*if ($value['Statuses']['status'] == 'Accepted' && $driverLatitude != '' && $driverLongitude != '' && $restaurantLatitude != '' && $restaurantLongitude != '') {
                            echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                                "from" => array("latitude" => $driverLatitude, "longitude" => $driverLongitude),
                                "to"   => array("latitude" => $restaurantLatitude, "longitude" => $restaurantLongitude)
                              ));
                        } elseif (($value['Statuses']['status'] == 'Picked up' || $value['Statuses']['status'] == 'On the way') && ($driverLatitude != '' && $driverLongitude != '' && $deliveryLatitude != '' && $deliveryLongitude != '')) {
                            echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
                                "from" => array("latitude" => $driverLatitude, "longitude" => $driverLongitude),
                                "to"   => array("latitude" => $deliveryLatitude, "longitude" => $deliveryLongitude)
                              ));
                        }*/
                          
                    }
       
                }
                
            }
        break;
        
        case 'OrderStatus':
        
            if (!empty($orderTrack)) {
                foreach ($orderTrack as $key => $value) { 
                   /* echo "<pre>"; print_r($value);
                    exit();*/
                    if (strtolower($value['Orderstatus']['status']) == 'reject') {
                        continue;
                    }
?>
                    <div class="popbox clearfix <?php echo strtolower(str_replace(' ','',$value['Orderstatus']['status'])) ?>">
                        <div class="col-lg-2 col-md-2 col-sm-3 box-left">
                           <span class="status">
                                 <?php
                                    echo $value['Orderstatus']['status'];
                                ?>
                            </span>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-6 assignorder"> <?php
                            switch ($value['Orderstatus']['status']) {
                               /* case 'New':
                                    echo 'Order received to '.$value['Restaurant']['restaurant_name'];
                                break;
                                case 'Waiting':
                                    echo 'Order assigned to '.$value['User']['firstname'];
                                break;
                                case 'Accepted':
                                    echo stripslashes($value['User']['firstname']).' accepted this order';
                                break;*/
                                case 'Driver Accepted':
                                    echo stripslashes($value['Driver']['driver_name']).' accepted this order from '.$value['Order']['Store']['store_name'];
                                break;
                                case 'Collected':
                                    echo stripslashes($value['Driver']['driver_name']).' collected order from '.$value['Order']['Store']['store_name'];
                                break;
                                case 'Delivered':
                                    echo stripslashes($value['Driver']['driver_name']).' delivered this order to '.stripslashes($value['Order']['customer_name']);
                                break;
                            }

                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 date">
                            <?php
                                echo $value['Orderstatus']['updated'];
                                
                            ?>
                        </div>
                    </div> <?php
                }
            }
            
        break; 
        
        case 'InitialTracking': 

            echo $this->GoogleMap->map();
        break;                                
    }
?>