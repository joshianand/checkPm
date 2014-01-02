<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Code Igniter Email sender</title>

        <style type="text/css">

            ::selection{ background-color: #E13300; color: white; }
            ::moz-selection{ background-color: #E13300; color: white; }
            ::webkit-selection{ background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body{
                margin: 0 15px 0 15px;
            }

            p.footer{
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container{
                margin: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to Code Igniter Email sender</h1>

            <form method="POST" action="<?php echo site_url('welcome/Sendemail'); ?>">
                <label>Select protocol</label>
                <select name="protocol">
                    <option value="mail">PHP mail</option>
                    <option value="sendmail">Sendmail</option>
                    <option value="smtp">SMTP</option>
                </select>
                
                <br/>
                <label>SMTP Server (for smtp protocol only)</label>
                <input name="smtpserver" type="text" value="" placeholder="Ex: mail.advanced-business-services-software.com" style="width: 300px;"/>
                <br/>
                <label>SMTP User (for smtp protocol only)</label>
                <input name="smtpuser" type="text" value="" placeholder="Ex: info@advanced-business-services-software.com" style="width: 300px;"/>
                <br/>
                <label>SMTP Password (for smtp protocol only)</label>
                <input name="smtppass" type="text" value="" placeholder="Ex: 12345"/>
                <br/>
                <label>SMTP Port (for smtp protocol only)</label>
                <input name="smtpport" type="text" value="25" placeholder="Ex: 25"/>
                <br/>
                
                <label>Source email</label>
                <input name="source" type="text" value="" placeholder="Ex: info@advanced-business-services-software.com" style="width: 300px;"/>
                <br/>
                
                <label>Destination email</label>
                <input name="destination" type="text" value="" placeholder="Ex: pranab.su@gmail.com" style="width: 300px;"/>
                <br/>
                
                <label>Your subject</label>
                <input name="subject" type="text" value="" placeholder="Ex: 12345"/>
                <br/>

                <label>Your message</label>
                <textarea name="message"></textarea>
                <br/>

                <button type="submit" value="submit">Submit</button>
            </form>
        </div>

    </body>
</html>