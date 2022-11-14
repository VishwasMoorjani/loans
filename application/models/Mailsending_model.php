<?php

class Mailsending_Model extends CI_Model
{

    public function __construct()
    {
        $this->load->library('email');
        $this->smtp_host = getSiteOption('smtp_host', true);
        $this->smtp_user = getSiteOption('smtp_user', true);
        $this->smtp_pass = getSiteOption('smtp_pass', true);
        $this->smtp_port = getSiteOption('smtp_port', true);
        $this->to = 'lokesh.gupta@xtreemsolution.com';
        $config['protocol'] = "smtp";
        $config['smtp_host'] = $this->smtp_host;
        $config['smtp_port'] = $this->smtp_port;
        $config['smtp_user'] = $this->smtp_user;
        $config['smtp_pass'] = $this->smtp_pass;
        $config['charset'] = "utf-8";
        $this->email->initialize($config);
    }

    public function assign_basic_data($body)
    {
        $this->logo = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo_2.png" class="logo-default"/>';
        $this->facebook_link = getSiteOption('clearunited_facebook_link', true);
        $this->twitter_link = getSiteOption('clearunited_twitter_link', true);
        $this->youtube_link = getSiteOption('clearunited_youtube_link', true);
        $this->linkedin_link = getSiteOption('clearunited_linkedin_link', true);
        $this->instagram_link = getSiteOption('clearunited_instagram_link', true);
        $body = str_replace('{{Logo}}', $this->logo, $body);
        $body = str_replace('{{facebook_link}}', $this->facebook_link, $body);
        $body = str_replace('{{twitter_link}}', $this->twitter_link, $body);
        $body = str_replace('{{youtube_link}}', $this->youtube_link, $body);
        $body = str_replace('{{linkedin_link}}', $this->linkedin_link, $body);
        $body = str_replace('{{instagram_link}}', $this->instagram_link, $body);
        $body = str_replace('{{google_plus_link}}', $this->google_plus, $body);
        return $body;
    }

    public function get_email_template($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get('tbl_emails');
        return $query->row();
    }

    public function get_user_record_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_users');
        $result = $query->row();
        return $result;
    }

    public function sendEmail($email, $subject, $body)
    {

        include_once APPPATH . "libraries/PHPMailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
        $mail->clearAttachments();
        $mail->isSMTP();
        $mail->Host = $this->smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_user;
        $mail->Password = $this->smtp_pass;
        $mail->Port = $this->smtp_port;
        $mail->setFrom($this->smtp_user, 'ClearUnited');

        if (is_array($email)) {

            foreach ($email as $key => $value) {
                $mail->addAddress($value);
            }
        } else {
            $mail->addAddress($email);
        }
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 0;
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->isHTML(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );
        $mail->send();
        return true;
    }

    public function get_verification_key_by_id($user_id, $type)
    {
        $this->db->select('tbl_verification_keys.*');
        $this->db->where('tbl_verification_keys.user_id', $user_id);
        $this->db->where('tbl_verification_keys.type', $type);
        $this->db->where('tbl_verification_keys.status', 'Active');
        $this->db->order_by('tbl_verification_keys.id', 'DESC');
        $query = $this->db->get('tbl_verification_keys');
        $result = $query->row();
        return $result;
    }

    public function send_email_user_verification_link($id)
    {
        $template = $this->get_email_template('email-verify');
        $subject = $template->subject;

        $verification_record = $this->get_verification_key_by_id($id, 'Email_Verification');

        $user = $this->get_user_record_by_id($id);
        $url = "https://www.clearunited.com/";
        $name = $user->first_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . $url . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo_2.png" class="logo-default"/>';
        $body = $this->assign_basic_data($str);
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $name, $str);
        $str = str_replace('{{Email_verified}}', $link, $str);

        $this->sendEmail($emailAddress, $subject, $str);
    }

/*    public function forgot_password_mail($user_id)
{

$template = $this->get_email_template('forgot-password');
$user = $this->get_verification_key_by_id_id, 'Forgot_Password');
$subject = $template->subject;
$email = $user->email_address;
$siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
$logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo_2.png" class="logo-default"/>';

$verification_link = site_url() . 'register/resetpassword/' . $user->verification_code;

$link = '<a href="' . $verification_link . '">Reset Password Link</a>';
$str = $template->content;
$str = str_replace('{{Logo}}', $logoURL, $str);
$str = str_replace('{{Email_Address}}', $email, $str);
$str = str_replace('{{Website_URL}}', $siteURL, $str);
$str = str_replace('{{password_reset_link}}', $link, $str);
$this->send_email($email, $subject, $str);
}*/

    public function reset_password_mail($user_id)
    {

        $template = $this->get_email_template('password-change');
        $user = $this->get_user_record_by_id($user_id);

        $subject = $template->subject;
        $email = $user->email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';

        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo_2.png" class="logo-default"/>';

        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{Email_Address}}', $email, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $this->sendEmail($email, $subject, $str);
    }

    public function forgotPasswordUserMailSending($userId, $forgotPasswordKey, $url)
    {
        $template = $this->get_email_template('forgot-password');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($userId);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
        $resetURL = $url;
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{Last_Name}}', $lastName, $str);
        $str = str_replace('{{Email_Address}}', $emailAddress, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $str = str_replace('{{password_reset_link}}', $resetURL, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }

    public function verification_notification($userId,$member_name)
    {
        $template = $this->get_email_template('verify-user-notification');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($userId);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
        //$Verify_link="https://www.clearunited.com/pages/user-information-verify";
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{member_name}}', $member_name, $str);
        // $str = str_replace('{{Verify_link}}', $Verify_link, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }
    public function to_verifier($firstName,$email)
    {
        $template = $this->get_email_template('verifier-email');
        $subject = $template->subject;
        $firstName = $firstName;
        $emailAddress = $email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
        //$Verify_link="https://www.clearunited.com/pages/user-information-verify";
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        // $str = str_replace('{{Verify_link}}', $Verify_link, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }
    public function to_who_verify($firstName,$email)
    {
        $template = $this->get_email_template('Verify-email');
        $subject = $template->subject;
        $firstName = $firstName;
        $emailAddress = $email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
        //$Verify_link="https://www.clearunited.com/pages/user-information-verify";
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        // $str = str_replace('{{Verify_link}}', $Verify_link, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }

    public function resetPasswordUserMailSending($userId, $forgotPasswordKey, $url)
    {
        $template = $this->get_email_template('set-password');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($userId);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
        $resetURL = $url;
        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{Last_Name}}', $lastName, $str);
        $str = str_replace('{{Email_Address}}', $emailAddress, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $str = str_replace('{{password_reset_link}}', $resetURL, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }

    public function ClearMedPayment($userId, $message)
    {
        $template = $this->get_email_template('clear-med-payment');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($userId);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        //$emailAddress = $user->email;
        $emailAddress = 'amit@mailinator.com';
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';

        $str = $template->content;
        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{Last_Name}}', $lastName, $str);
        $str = str_replace('{{Email_Address}}', $emailAddress, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $str = str_replace('{{Message}}', $message, $str);

        $this->sendEmail($emailAddress, $subject, $str);
    }

    public function sendEmailUserVerifiedLink($email)
    {
        $template = $this->templatechoose('welcome-new-user');
        $subject = $template->subject;
        $user = $this->getUserRecordByEmail($email);
        $url = "https://www.clearunited.com/";
        $firstName = $user->first_name;
        $emailAddress = $user->email_address;
        $siteURL = '<a href="' . $url . '">Visit ClearUnited</a>';
        $logoURL = '';
        $link = $url . 'pages/email-verified/' . $user->verification_code;
        $str = $template->content;

        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{Email_Address}}', $emailAddress, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $str = str_replace('{{Email_verified}}', $link, $str);
        $this->sendEmail($emailAddress, $subject, $str);

    }



    public function sendEmailUserCommissionReceived($user_id)
    {
        $template = $this->templatechoose('get-commission');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($user_id);
        $url = "https://www.clearunited.com/";
        $firstName = $user->first_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . $url . '">Visit ClearUnited</a>';
        $logoURL = '';
        $body = $this->assign_basic_data($str);
        $str = $template->content;

        $str = str_replace('{{Logo}}', $logoURL, $str);
        $str = str_replace('{{First_Name}}', $firstName, $str);
        $str = str_replace('{{Email_Address}}', $emailAddress, $str);
        $str = str_replace('{{Website_URL}}', $siteURL, $str);
        $str = str_replace('{{Email_verified}}', $link, $str);
       
        $this->sendEmail($emailAddress, $subject, $str);

    }

    public function templatechoose($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get('tbl_emails');
        return $query->row();
    }

    public function getUserRecordByEmail($email)
    {
        $this->db->select('tbl_user_email_verification_codes.id as code_id, tbl_user_email_verification_codes.verification_code, tbl_user_email_verification_codes.expiry_date, tbl_user_email_verification_codes.email_address');
        $this->db->select('tbl_users.*');
        $this->db->join('tbl_users', 'tbl_user_email_verification_codes.user_id = tbl_users.id');
        $this->db->where('tbl_user_email_verification_codes.email_address', $email);
        $this->db->where('tbl_user_email_verification_codes.status', 'Active');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_user_email_verification_codes');
        $result = $query->row();
        return $result;
    }

    public function forgot_password_mail($user_id,$forgotPasswordKey)
    {   
        $template = $this->get_email_template('forgot-password');
        $subject = $template->subject;
        $user = $this->get_user_record_by_id($user_id);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $emailAddress = $user->email;
        $siteURL = '<a href="' . site_url() . '">Visit ClearUnited</a>';
        $logoURL = '<img src="' . $this->config->item('admin_assets') . 'global/img/sport_logo.png" class="logo-default"/>';
       // $resetURL = '<a href="http://192.168.1.55:4200/reset-password/'. $forgotPasswordKey. '">Reset Password</a>';
        $resetURL = '<a href="http://staging.clearunited.com/reset-password/'. $forgotPasswordKey. '">Reset Password</a>';

        $str = $template->content;
        $str = str_replace('{{password_reset_link}}', $resetURL, $str);
        $this->sendEmail($emailAddress, $subject, $str);
    }


    public function test($email = 'teamindia@clearcenter.com')
    {

        include_once APPPATH . "libraries/PHPMailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
        $mail->clearAttachments();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Username = "invite@clearunited.com";
        $mail->Password = "<37VLbCV";
        $mail->Port = 465;
        $mail->setFrom('invite@clearunited.com', 'Clearunited');

        if (is_array($email)) {

            foreach ($email as $key => $value) {
                $mail->addAddress($value);
            }
        } else {
            $mail->addAddress($email);
        }
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 1;
        $mail->Subject = "Hello Vikas";
        $mail->Body = "This is a test";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );
        $mail->send();
        echo "Send";
    }

}
