<?php
/**
 * Functions Component
 *
 * PHP version 5
 *
 * @category Helper
 */

App::uses('Component', 'Controller');

class FunctionsComponent extends Component
{

    public function getSlug($sTitle)
    {
        $slug = Inflector::slug($sTitle, '-');
        $slug = strtolower($slug);
        return $slug;
    }

    /**
     * @value = array();
     * @return trimmed array() output.
     */
    public function trim_value($value)
    {
        $group = array();
        foreach ($value as $key => $val):
            if (!(is_array($value["$key"])))
                $group[$key] = trim($value["$key"]);
        endforeach;
        return $group;
    }

    /**
     *    input format:dd.mm.yyyy
     *    Return format: yyyy-mm-dd
     */
    public function formatDateToDB($date, $time = false)
    {
        if ($time == true) {
            list($date, $time) = explode(' ', $date);
            return substr($date, 6, 4) . '-' . substr($date, 3, 2) . '-' . substr($date, 0, 2) . " " . $time;
        } else
            return substr($date, 6, 4) . '-' . substr($date, 3, 2) . '-' . substr($date, 0, 2);
    }

    /**
     *    input format:dd/mm/yyyy
     *    Return format: yyyy-mm-dd
     */
    public function xlsFormatDateToDB($date)
    {
        return substr($date, 6, 4) . '-' . substr($date, 3, 2) . '-' . substr($date, 0, 2);;
    }

    /**
     *    input format:yyyy-mm-dd
     *    Return format: dd.mm.yyyy
     */
    public function dateDisplay($date, $seperator = '.')
    {
        return substr($date, 8, 2) . $seperator . substr($date, 5, 2) . $seperator . substr($date, 0, 4);
    }

    /**
     * $mail['from'],
     * $mail['replyTo'],
     * $mail['to'],
     * $mail['sendAs'],
     * $mail['layout'],
     * $mail['subject'],
     * $mail['template']
     */
    public function sendMail($mail, $attachments = array(), $cc = array(), $bcc = array())
    {
        if (!isset($mail['sendAs']))
            $mail['sendAs'] = 'html';
        if (!isset($mail['layout']))
            $mail['layout'] = 'email';
        if (!isset($mail['subject']))
            $mail['subject'] = '';
        $this->Email->reset();
        $this->Email->from = $mail['from'];
        $this->Email->replyTo = $mail['replyTo'];
        $this->Email->to = $mail['to'];
        $this->Email->cc = $cc;
        $this->Email->bcc = $bcc;
        $this->Email->sendAs = $mail['sendAs'];
        $this->Email->layout = $mail['layout'];
        $this->Email->subject = $mail['subject'];
        $this->Email->template = $mail['template'];
        $this->Email->attachments = $attachments;
        $status = $this->Email->send();

        return $status;
    }

    function funcTruncate($string, $limit, $break = " ", $pad = "...")
    {
        if (strlen($string) <= $limit) return $string;
        if (false !== ($breakpoint = strpos($string, $break, $limit))) {
            if ($breakpoint < strlen($string) - 1) {
                $string = substr($string, 0, $breakpoint) . $pad;
            }
        }
        return $string;
    }

    function customTruncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
    {
        if ($length == 0)
            return '';
        $string = strip_tags($string);
        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }
            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            } else {
                return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
            }
        } else {
            return $string;
        }
    }

    //Create random generated password
    function randomPassword($PwdLength = 8, $PwdType = 'standard')
    {
        $Ranges = '';

        if ('test' == $PwdType) return 'test';
        elseif ('standard' == $PwdType) $Ranges = '65-78,80-90,97-107,109-122,50-57';
        elseif ('alphanum' == $PwdType) $Ranges = '65-90,97-122,48-57';
        elseif ('any' == $PwdType) $Ranges = '40-59,61-91,93-126';

        if ($Ranges <> '') {
            $Range = explode(',', $Ranges);
            $NumRanges = count($Range);
            mt_srand(time());
            $p = '';
            for ($i = 1; $i <= $PwdLength; $i++) {
                $r = mt_rand(0, $NumRanges - 1);
                list($min, $max) = explode('-', $Range[$r]);
                $p .= chr(mt_rand($min, $max));
            }
            return $p;
        }
    }

    function getFileExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
    /*function dbdateformat($srcdata = null) {
		list($date,$time) = split(" ",$srcdata);
        list($d,$m,$y) = split("/",$date);
        $mysqldate = $y."-".$m."-".$d." ".$time;
        return $mysqldate;
	}*/
    /**
     *    input format:  12.900000
     *    Return format: 12.90
     */

    function dateDiff($sDate, $eDate)
    {
        $date_diff = strtotime($eDate) - strtotime($sDate);
        return $days = ($date_diff / (60 * 60 * 24)); //( 60 * 60 * 24) // seconds into days

    }


    /**
     * dateTimeDisplay
     * returns date and time as specified
     * input format : yyyy-mm-dd H:i:s
     * output format : dd.mm.yyyy
     * @var array
     * @access public
     */
    public function datetimeDisplay($date, $setTime = false, $seperator = '.')
    {
        $date = trim($date);
        if (empty($date) || $date == "0000-00-00" || $date == "0000-00-00 00:00:00")
            return '-';
        $time = '';
        if (strstr($date, ' ')) {
            if ($setTime == true) {
                list($date, $time) = explode(" ", $date);
                $newtime = explode(":", $time);
                $time = $newtime[0] . ":" . $newtime[1];
            }
        }
        return substr($date, 8, 2) . $seperator . substr($date, 5, 2) . $seperator . substr($date, 0, 4) . " " . $time;
    }

    public function generatepackagePdf($Products, $pdfdoc = 'document')
    {
        require_once(APP . 'Vendor' . DS . 'fpdf' . DS . 'html2fpdf.php');

        $output = '
            <h1 align="center">Shop Products Order Report </h1>
            <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr class="striped" bgcolor="#bfbfbf">
                    <th align="left">Product Name</th>
                    <th align="left">Category</th>
                    <th align="left">Price</th>
                    <th align="left">Quantity Sold</th>
                    <th align="left">Quantity inhand</th>
                </tr>';

        $i = 1;

        foreach ($Products as $Product): $i++;
            if ($i % 2 == 0) $bg = '#cecece'; else $bg = '#e6e6e6';
            $output .= '<tr bgcolor="' . $bg . '">
            <td>' . $Product['Product']['title'] . '</td>
            <td>' . $Product['Category']['name'] . '</td>
            <td>' . $Product['Product']['compare_price'] . '</td>
            <td>' . count($Product['Orderitem']) . '</td>
            <td>' . $Product['Product']['qty_in_hand'] . '</td>
        </tr>';
        endforeach;

        $output .= '</table>';

        //require_once 'Vendor/fpdf/html2fpdf.php';
        $pdf = new HTML2FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 5);
        $pdf->WriteHTML($output);
        $pdf->Ln(5);

        //output the document
        $filelangName = __d('Report', 'image_PDF', true);
        $fileRefName = $filelangName . "-" . date('Y-m-d');

        $fileName = $fileRefName;
        $pdf->Output("pdf_doc/$fileName.pdf", 'D');
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$pdfdoc.pdf");
        // The PDF source is in original.pdf
        readfile("pdf_doc/$fileName.pdf");
        unlink("pdf_doc/$fileName.pdf");

        exit ();
    }

    public function generateOrderPdf($order_detail, $pdfdoc = 'document')
    {

        //echo "<pre>";print_r($order_detail);exit();
        require_once(APP . 'Vendor' . DS . 'fpdf' . DS . 'html2fpdf.php');
        $outputs = '
        <table width="100%"  align="center">
            <tr style="display:block; width:100%;">
                <td colspan="2" style="display:inline-block;font:bold 22px/30px Arial; padding:5px 0px 10px;" align="center">
                    Order Invoice
                </td>
            </tr>
            <tr style="display:block; width:100%;">
                <td style="display:inline-block;font:bold 20px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                    ' . $order_detail['Order']['ref_number'] . '
                </td>
                <td style="display:inline-block;font:bold 20px/20px Verdana; padding:10px 0px 5px; text-align:right;">
                    ' . $order_detail['Order']['created'] . '
                </td>
            </tr>
        </table>
        <table width="100%"  align="center" style="margin:10px 0px; border:10px solid #eee;">
            <tbody >

                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Name </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['customer_name'] . '</td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Email </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['customer_email'] . '
                    </td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Address </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['address'] . '
                    </td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Phone </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['customer_phone'] . '
                    </td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Delivery Time </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['updated'] . '
                    </td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Payment Method </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['payment_type'] . '
                    </td>
                </tr>
                <tr style="display:block; width:100%;">
                    <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Payment Status </td>
                    <td align="" style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;">: ' . $order_detail['Order']['payment_method'] . '
                    </td>
                </tr>
            </tbody >
        </table>


        <table width="100%"  align="center" style="margin:10px 0px; border:10px solid #eee;">
            <thead>
                <tr style="display:block; width:100%;">
                    <th style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">S.No</th>
                    <th align="left">Item Name</th>
                    <th style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Qty</th>
                    <th style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Price</th>
                    <th style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">Total Price</th>
                </tr>
            </thead>
            <tbody>';
        $count = 1;
        foreach ($order_detail['ShoppingCart'] as $key => $value) {
            $outputs .= '
                    <tr style="display:block; width:100%;">
                        <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' . $count . '</td>

                        <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' . $value['product_name'] . '</td>
                        <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' . $value['product_quantity'] . '</td>
                        <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' . $value['product_price'] . '</td>
                        <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' . $value['product_total_price'] . '</td>
                    </tr>';
            $count++;
        }
        $outputs .= '
                        <tr >
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;" colspan="5">Subtotal</td>
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">' .
            $order_detail['Order']['order_sub_total'] . '</td>
                        </tr>';
        if ($order_detail['Order']['tax_amount'] != 0) {
            $outputs .= '
                         <tr >
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;" colspan="5">Tax</td>
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">
                                ' . $order_detail['Order']['tax_amount'] . '</td>

                        </tr>';
        }
        if ($order_detail['Order']['delivery_charge'] != 0) {
            $outputs .= '
                       <tr >
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;" colspan="5">Delivary Charge</td>
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;">
                                ' . $order_detail['Order']['delivery_charge'] . '</td>
                        </tr>';
        }
        $outputs .= '
                        <tr >
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;" colspan="5">Total</td>
                            <td style="font:14px/17px Verdana;padding:5px 0px 5px;border-bottom:1px solid #ddd;padding-right:20px; padding-left:20px;"><b>
                            ' . $order_detail['Order']['order_grand_total'] . '</b></td>

                        </tr>';

        $outputs .= '</tbody>
        </table>


';


        $pdf = new HTML2FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 5);
        $pdf->WriteHTML($outputs);
        $pdf->Ln(5);

        //output the document
        $filelangName = __d('Order Report', 'image_PDF', true);
        $fileRefName = $filelangName . "-" . date('Y-m-d');

        $fileName = $fileRefName;
        $pdf->Output("pdf_doc/$fileName.pdf", 'D');
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$pdfdoc.pdf");
        // The PDF source is in original.pdf
        readfile("pdf_doc/$fileName.pdf");
        unlink("pdf_doc/$fileName.pdf");

        exit ();
    }

    public function generateOrderpackagePdf($getOrderData, $pdfdoc = 'document')
    {
        require_once(APP . 'Vendor' . DS . 'fpdf' . DS . 'html2fpdf.php');

        $output =

            '    <div style="width:960px;margin:0 auto;">
        <h1 align="center">Shop Order Report </h1>
        <table width="100%" cellspacing="0" cellpadding="0" border="1">
            <tbody>
                <tr class="striped" bgcolor="#bfbfbf">
                    <th align="left" width="45%"> Product 	</th>
                    <th align="left" width="15%"> Category 	</th>
                    <th align="left" width="10%"> Qty   	  	</th>
                    <th align="left" width="15%"> Price		</th>
                    <th align="left" width="15%"> Total price</th>
                </tr>';

        foreach ($getOrderData['Orderitem'] as $Orderitem) {

            $output .= '<tr style="font:normal 14px Arial">
                    <td style="border-bottom:1px solid #ccc; padding:5px">' . $Orderitem['Product']['title'] . '</td>
                    <td style="border-bottom:1px solid #ccc; padding:5px">' . $Orderitem['Product']['Category']['name'] . '</td>
                    <td style="border-bottom:1px solid #ccc; padding:5px">' . $Orderitem['quantity'] . ' </td>

                    <td style="border-bottom:1px solid #ccc; padding:5px">' . $Orderitem['price'] . ' </td>
                    <td style="border-bottom:1px solid #ccc; padding:5px">' . $Orderitem['subtotal'] . ' </td>
                </tr>';
        }
        $output .= '<tr class="odd gradeX">
                    <td colspan="4" align="right"  class="bold"> Tax </td>
                    <td>' . $getOrderData['Order']['tax'] . '</td>
                </tr>
                <tr class="odd gradeX">
                    <td colspan="4" align="right"  class="bold"> Shipping charge </td>
                    <td>' . $getOrderData['Order']['shipping'] . '</td>
                </tr>
                <tr class="odd gradeX">
                    <td colspan="4" align="right" class="bold"> Grand Total </td>
                    <td>' . $getOrderData['Order']['grandtotal'] . '</td>
                </tr>
            </tbody>
        </table>
        </div>';

        $output .= '    <div style="width:960px;margin:0 auto;">
            <table width="980" border="1"  >
                <tr><td>
                    <table width="50%" border="1">
                        <tr>
                            <th><span style="font:12px Arial">Order Details</span></th>
                        </tr>
                        <tr>
                            <td><label style="font-size:12px; font-weight:normal;"> Order Number : ' . $getOrderData['Order']['id'] . '</label></td>
                        </tr>
                        <tr>
                            <td><label style="font-size:12px; font-weight:normal;"> Order Status : ' . $getOrderData['Order']['status'] . '</label>
                            </td>
                        </tr>
                         <tr>
                            <td><label style="font-size:12px; font-weight:normal;"> Shipping Method : ' . $getOrderData['Countryshipping']['shippingname'] . '</label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                <table width="50%" align="right" border="1">
                    <tr>
                       <th style="background:#ccc;"><span style="font:14px Arial">Payment Details </span></th>
                    </tr>
                    <tr>
                        <td><label class=""> Payment status :  ' . $getOrderData['Order']['payment_status'] . '</label></td>
                    </tr>
                    <tr>
                        <td><label class="">  Payment method : ' . $getOrderData['Order']['payment_type'] . ' </label></td>
                    </tr>
                </table>
                </td></tr>
            </table>



<h3 class="col-sm-12 alert alert-info text-center"> Customer Details </h3>
<div class="row">
	<div class="col-md-4">
	    <div class="portlet light bg-inverse clearfix">
	        <div class="portlet-title">
	            <div class="caption">
	                <span class="caption-subject bold font-red-flamingo uppercase"> Customer Info </span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <label class=""> Customer name :  ' . $getOrderData['User']['username'] . '</label><br>
	            <label class=""> Customer Email : ' . $getOrderData['User']['email'] . '</label><br>
	            <label class=""> Customer Contact : ' . $getOrderData['Customer']['phone'] . '</label><br>
	        </div>
	    </div>
	</div>
</div>

<div class="col-md-4">
    <div class="portlet light bg-inverse clearfix">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold font-red-flamingo uppercase">
                	Billing Address </span>
            </div>
        </div>
        <div class="portlet-body">
            <label class=""> First Name :  ' . $getOrderData['CustomerBillingAddress']['firstname'] . '
            </label><br>
            <label class=""> Last name :  ' . $getOrderData['CustomerBillingAddress']['lastname'] . '
            </label><br>
            <label class=""> Address :  ' . $getOrderData['CustomerBillingAddress']['billing_address'] . '
            </label><br>
            <label class=""> Address2 :  ' . $getOrderData['CustomerBillingAddress']['billing_address2'] . '
            </label><br>
            <label class=""> City :  ' . $getOrderData['CustomerBillingAddress']['billing_city'] . '
            </label><br>
            <label class=""> Zip Code :  ' . $getOrderData['CustomerBillingAddress']['billing_zipcode'] . '
            </label><br>
            <label class=""> State :  ' . $getOrderData['CustomerBillingState'] . '
            </label><br>
            <label class=""> Country :  ' . $getOrderData['CustomerBillingCountry'] . '
            </label><br>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="portlet light bg-inverse clearfix">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold font-red-flamingo uppercase">
                	Shipping Address </span>
            </div>
        </div>
        <div class="portlet-body">
            <label class=""> First Name :  ' .
            $getOrderData['CustomerShippingAddress']['firstname'] . '
            </label><br>
            <label class=""> Last Name :  ' .
            $getOrderData['CustomerShippingAddress']['lastname'] . '
            </label><br>
            <label class=""> Address :  ' .
            $getOrderData['CustomerShippingAddress']['shipping_address'] . '</label><br>
            <label class=""> Address2 :  ' .
            $getOrderData['CustomerShippingAddress']['shipping_address2'] . '</label><br>
            <label class=""> City :  ' .
            $getOrderData['CustomerShippingAddress']['shipping_city'] . '</label><br>
            <label class=""> Zip Code :  ' .
            $getOrderData['CustomerShippingAddress']['shipping_zipcode'] . '</label><br>
            <label class=""> State :  ' .
            $getOrderData['CustomerShippingState'] . '</label><br>
            <label class=""> Country :  ' .
            $getOrderData['CustomerShippingCountry'] . '</label><br>
        </div>
    </div>
</div>
</div>';


        $pdf = new HTML2FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 5);
        $pdf->WriteHTML($output);
        $pdf->Ln(5);

        //output the document
        $filelangName = __d('Report', 'image_PDF', true);
        $fileRefName = $filelangName . "-" . date('Y-m-d');

        $fileName = $fileRefName;
        $pdf->Output("pdf_doc/$fileName.pdf", 'D');
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$pdfdoc.pdf");
        // The PDF source is in original.pdf
        readfile("pdf_doc/$fileName.pdf");
        unlink("pdf_doc/$fileName.pdf");

        exit ();
    }

    public function generatePDF_invoice($invoices, $pdfdoc = 'document')
    {

        /*$CurrencySymbol = ClassRegistry::init('Currency')->findById($invoice['Store_general']['currency'])

        $Currency= $CurrencySymbol['Currency']['currency_symbol'];*/
        echo "jj";
        echo "<pre>";
        print_r($invoices);
        echo "</pre>";
        die();

        require_once(APP . 'Vendor' . DS . 'fpdf' . DS . 'html2fpdf.php');

        $output = '
        <h1 align="center">Invoices</h1>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr class="striped" bgcolor="#bfbfbf">
            <th align="left">Store Name</th>
            <th align="left">Email Address</th>
            <th align="left">Plan Name</th>
            <th align="left">Amount</th>
            <th align="left">Upgraded On</th>
            <th align="left">Due Date</th>
            <th align="left">Payment Method</th>
        </tr>';

        $i = 1;
        foreach ($invoices as $invoice): $i++;
            if ($i % 2 == 0) $bg = '#cecece'; else $bg = '#e6e6e6';
            $output .= '<tr font size="3" bgcolor="' . $bg . '">
           	<td>' . $invoice['Store_general']['name'] . '</td>
			<td>' . $invoice['Store_general']['email'] . '</td>
			<td>' . $invoice['Plan']['name'] . '</td>
			<td>' . $invoice['Plan']['price'] . '</td>
			<td>' . date_format(new DateTime($invoice['PackagesOrder']['invoice_date']), "M d,Y") . '</td>
			<td>' . date_format(new DateTime($invoice['PackagesOrder']['endDate']), "M d,Y") . '</td>
			<td>' . $invoice['PackagesOrder']['payment_type'] . '</td>

        </tr>';
        endforeach;

        $output .= '</table>';

        //require_once 'Vendor/fpdf/html2fpdf.php';
        $pdf = new HTML2FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 5);
        $pdf->WriteHTML($output);
        $pdf->Ln(5);

        //output the document
        $filelangName = __d('Report', 'image_PDF', true);
        $fileRefName = $filelangName . "-" . date('Y-m-d');

        $fileName = $fileRefName;
        $pdf->Output("pdf_doc/$fileName.pdf", 'D');
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$pdfdoc.pdf");
        // The PDF source is in original.pdf
        readfile("pdf_doc/$fileName.pdf");
        unlink("pdf_doc/$fileName.pdf");

        exit ();
    }


    public function createTempPassword($len)
    {
        $pass = '';
        $lchar = 0;
        $char = 0;
        for ($i = 0; $i < $len; $i++) {
            while ($char == $lchar) {
                $char = rand(48, 109);
                if ($char > 57) $char += 7;
                if ($char > 90) $char += 6;
            }
            $pass .= chr($char);
            $lchar = $char;
        }
        return $pass;
    }

    public function sumOfDetail($detail, $tax, $cardfess)
    {
        $total = 0;
        $cod = 0;
        $cod_total = 0;
        $stripe_total = 0;
        $stripe = 0;
        $total_oreder = 0;
        foreach ($detail as $key => $value) {
            $total_oreder++;
            $total = $total + $value['Order']['order_sub_total'];
            if ($value['Order']['payment_type'] == 'cod') {
                $cod++;
                $cod_total = $cod_total + $value['Order']['order_sub_total'];

            } else {
                $stripe++;
                $stripe_total = $stripe_total + $value['Order']['order_sub_total'];
            }

        }
        $result['total_order'] = $total_oreder;
        $result['tax'] = $cod_total * ($tax / 100);
        $result['stripe_tax'] = $stripe_total * ($cardfess / 100);
        $result['total'] = $total;
        $result['cod_count'] = $cod;
        $result['stripe_count'] = $stripe;
        $result['cod_total'] = $cod_total;
        $result['stripe_total'] = $stripe_total;
        return $result;

    }

    public function seoUrl($string)
    {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower(trim($string));
        //Strip any unwanted characters
        $string = str_replace('/', '-', $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

    public function parseSerialize($serializeData)
    {
        $data = array();
        parse_str($serializeData, $data);
        return $data;
    }

    public function dashboardCalculation($information,$invoiceDetail){
        $total = $commisionTotal = $total_oreder = $commisionTaxTotal = $commisionGrandTotal = 0;
        foreach($information as $key => $value){
            $total_oreder++;
            $total = $total + $value['Order']['order_sub_total'];
        }
        $result['totalorder']    = $total_oreder;
        $result['total']         = $total;
        foreach($invoiceDetail as $keys => $values){
            $commisionTotal      = $commisionTotal + $values['Invoice']['commision'];
            $commisionTaxTotal   = $commisionTaxTotal + $values['Invoice']['commision_tax'];
            $commisionGrandTotal = $commisionGrandTotal + $values['Invoice']['commisionGrand'];
        }
        $result['totalorder']          = $total_oreder;
        $result['total']               = $total;
        $result['commisionTotal']      = $commisionTotal;
        $result['commision_tax']       = $commisionTaxTotal;
        $result['commisionGrandTotal'] = $commisionGrandTotal;
        return $result;
    }

}