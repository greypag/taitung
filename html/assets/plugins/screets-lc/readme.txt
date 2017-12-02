=== Screets Live Chat ===
Tags: chat, contact, support, email
Requires at least: 4.3
Tested up to: 4.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Chat with your visitors on your website.

== Installation ==

1. Upload `screets-lc` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

Full change log... We always try to keep our products up-to-date and secure.

    Legend:

    [+] - new feature/improvement
    [*] - functionality changes
    [!] - bugfix

    Version 2.2.6 - 3 December 2016
        [+] Added Live Chat box to Appearance > Menus to manage your site menus
        [+] Added Turkish language support
        [*] Fixed the console error when unknown user data update that crashes the console
        [!] Fixed multiple emails issue for site notification emails

    Version 2.2.5 - 2 October 2016
        [+] Supports WordPress 4.6+
        [*] Operators can see "Restart" button in console settings
        [*] Updated titan framework into 1.10
        [!] Fixed SSL issue. Now fully supported
        [!] Fixed broken icons issue (front-end)
        [!] Fixed back-end options errors when the language is different than English
        [!] Fixed font-color in design chat options
        
    Version 2.2.4 - 22 July 2016
        [*] Updated to Firebase 3.2.0
        [*] Removed "logout" and "database" buttons from chat settings found in chat console
        [!] Fixed WPML 3.4 compatibility. Now it is working with WPML 3.2 and all newer versions.
        [!] Fixed operator display name issue
        [!] Fixed "restart" button issue found in chat console > settings
        
    Version 2.2.3 - 1 July 2016
        [!] Fixed 403 error happens in some PHP/Apache server installations.

    Version 2.2.2 - 26 June 2016
        [+] Added WPML support (WPML 3.2 and newer versions)
        [+] Supports wp-content/languages/screets-chat folder to add your translations like schat-fr_FR.mo
        [!] Fixed online/offline issue
        
    Version 2.2.1 - 24 June 2016
        [!] Fixed wrong redirection on front-end when Firebase info are missing in integration options

    Version 2.2.0 - 24 June 2016
        [+] Supporting new Firebase API v3 (you should migrate too if you update)

    Version 2.1.5 - 10 June 2016
        [!] Fixed Gravity Forms plugin compatibility 
        
    Version 2.1.4 - 29 May 2016
        [+] Compatible with PHP 7
        [*] Because of some email services only accept verified domains, now FROM part of all notification emails changed with your site email. However, REPLY-TO part will be filled out with visitors' email as long as they provided an email.
        [!] Fixed wrong site email address used for notification emails
        [!] Fixed refreshing page issue when visitor clicks enter to submit to form (all forms)

    Version 2.1.3 - 21 April 2016
        [!] Fixed autofill issue on forms :)
        [*] WP 4.5 compatibility
        [*] Removed "Ideas" button from chat options
        [*] Using wp_get_current_user() function instead of old get_currentuserinfo()

    Version 2.1.2 - 21 March 2016
        [+] Now you can disable new visitor and new message notifications in Chat Console > Settings
        [!] Fixed operator name issue. Click "restart" button (Chat Console > Settings) after updating operator info in your user profile
        [!] Fixed the issue when WPML plugin is active

    Version 2.1.1 - 27 Jan 2016
        We have fixed known issues and made more compatible with WordPress plugins and themes. Also there are new features and UI improvements for both front-end and back-end even though it is maintenance update.

        [+] Added "Send" button for mobile visitors
        [+] Added timeago for visitors when they joined the chat (chat console)
        [+] Added shortcode: [cx-button]Live chat[/cx-button]
        [+] Added reset CSS to make it more compatible with all themes
        [+] Added "Force to use as default operator avatar" option for site logo
        [+] Now chat widget fully responsive
        [*] Removed IE support script from back-end
        [*] Improved console UI
        [*] OPs can't reply when they're offline just like visitors
        [*] Changed admin menu icon of Live Chat
        [*] Changed "Refresh" and "Erase data" buttons in chat console settings with "Re-login" and "Restart" buttons which are more useful
        [!] Unknown cities not show up as "false" anymore in chat console..
        [!] Fixed "Online/offline" status
        [!] Now visitors hear sound notifications
        [!] Post-chat popup can be disabled now
        [!] Fixed "Hide when offline" option.. Widget doesn't show up even there is active conversation when all operators offline

    Version 2.1 - 4 January 2016
        [+] Added social links (appears in post-chat and offline modes)
        [+] Added "Chat logs" link
        [+] Added "End chat" link
        [+] Added "Email chat history"
        [+] Added "Specific pages & categories" feature in general options
        [+] Added "x is typing..." notification for both operator and visitor
        [+] Added Polylang support (multilingual translations)
        [+] Added post-chat popup
        [+] Added "Email chat history" button in postchat
        [+] Added new hook: "schat_email_chat_subject"
        [+] Added functionality to clean up junk users on page load (in chat console)
        [*] Custom CSS is embedded in Titan Framework. Now design options and your custom CSS codes are more compatible with themes and plugins
        [*] Added all front-end links rel="nofollow" attribute to help search engines
        [*] The notifications in chat conversation (i.e. "x" is joined chat) can be also seen by operators 
        [*] Changed "Enable" option value with "Show" & "Hidden" to make compatible with new feature "Specific pages & categories"
        [*] Removed strings that can be translated in chat options (i.e. "Your name", "Email") from PO file in languages folder
        [!] Fixed addEventListener issue on chat console for Chat Operator users
        [!] Hides "We're online" notification in offline form when all operators are offline
        [!] Fixed shadow/light issue. Its showing right now
        [!] Fixed Pushover. Its sending notifications now
        [!] Fixed page sliding issue when visitor opens the chat widget in front-end
        [!] Fixed link color
        [!] Fixed IE JavaScript and UI errors
        [!] Fixed "hide when all operators" option
        
    Version 2.0.5 - 19 December 2015
        [+] Added new "Question" and "Phone" fields into Pre-chat (login form)
        [+] New "first auto-reply" field into online chat options
        [+] Desktop notifications for operators
        [+] Operator status (joined or left chat) shown in visitor conversation
        [+] Chat button shows up immediately on page startup and update chat title when its connected to the database (Firebase)
        [+] Added new flag icons for chat console
        [+] Warn operator before page exit if the operator is online
        [+] Showing geo-location for visitors (included https users)
        [+] Added "re-login" and "reset" buttons in chat console to help you to refresh connections or reset all your chat data
        [*] Improved user connections reliability
        [*] Updated greeting/welcome fields in design chat options with "editor" style
        [*] Chat box is more compatible with major browsers
        [*] Chat box pops up when operator sends new message as long as the visitor didn't minimize the chat box himself on current page refresh
        [*] Added geo-location service to our Screets server that supports https requests
        [*] Removed other geo-location services 
        [*] Name visitor with IP addresses instead of random guest name
        [*] Custom CSS is in the HTML code. It has the lowest server impact instead of creating dynamic CSS file.
        [*] Checked with W3 validator
        [*] Removed attention grabber feature for this version
        [*] "Offline messages" link removed (temporarily)
        [*] Google Maps removed from options
        [!] Fixed "Button Size" option issue
        [!] Fixed default avatar issue. It shows "site logo" option as default avatar of operators
        
    Version 2.0.4 - 4 December 2015
        [!] Removed duplicated strings and excluded "library" folder from translation
        [!] Fixed attention grabber
        [!] Removed insecure connection to geo location server if website use SSL
        
    Version 2.0.3 - 3 December 2015
        [+] Form fields are customizable in design chat option (sortable, show/hide, required/optional and translatable)
        [+] Added "get_users" function in schat.firebase.js
        [+] Shows "new message count" on chat button when popup is closed
        [+] Added "del_session" function in schat.firebase.js
        [+] Added notification to offline form when an operator become online
        [*] Uses localdomain part of email (before "@" part) when no name provided in pre-chat form
        [*] Users list more stable now
        [*] Inactive users not included in to users list
        [*] Added function to clean up junk chats, inactive visitors and old sessions in every console initialization
        [*] Removed "delay" option
        [*] Removed "Offline Active/Inactive" option. Instead, use "Hide when offline"
        [*] Offline operators also has "star" icon like online operators
        [*] Changed "remove_user" functions with "del_user" in schat.firebase.js
        [*] Changed "msg-remove" event with "msg-del" in schat.firebase.js
        [*] Changed "msg-remove" event with "msg-del" in schat.firebase.js
        [*] Added "get_chats" function in schat.firebase.js
        [*] Removed "end chat" button from console. We'll add better functionality in the next updates for it.
        [!] URLs made compatible with SSL
        [!] Fixed "attention grabber" option
        [!] Fixed "popup size" and "padding" options. Its working now
        [!] Fixed missed icons in chat box
        [!] Fixed deleted conversation in console when visitor refresh the page
        [!] Fixed chat box size issues. It is responsive now
        [!] Fixed wrong unread messages count in window title (front-end)

    Version 2.0.2 - 1 December 2015
    [!] Fixed known issues on PHP 5.4 servers.. Gosh !

    Version 2.0.1 - 1 December 2015
    [!] Compatible with PHP 5.4

    Version 2.0 - 1 December 2015
        [+] Completely new
        [+] Rewritten the core from scratch
        [+] Redesigned user interface
        [+] Developed in pure JavaScript (no longer depend on JS libraries like jQuery)
        [+] Emoji support across all platforms (Twitter Emoji)
        [+] Operator can start chat with web visitors
        [+] Operators can see geolocation, browser and OS info of visitors
        [+] Advanced visibility options
        [+] Advanced privacy options (show chat box to only specific user roles. ie. show only to customers and shop managers)
        [+] Added WordPress and JavaScript API for developers
        [+] Change online / offline button texts according to operators connection status
        [+] Hide chat box when all operators offline
        [+] Added attention grabber image
        [+] Customize forms (prechat, login and offline forms)
        [*] Removed PHP sessions (not using anymore)

    Version 1.4.3 - 21 May 2015
        [!] Fixed security rules

    Version 1.4.2 - 29 November 2014
        [+] Added Polish language (Mateusz Tchorz)
        [+] Added Spanish language (José Atencio)
        [+] Added French language (Adrien Romain)
        [*] Updated Firebase 1.0.24
        [*] Login form is required for all visitors for now. Some PHP/Apache servers conflict with guests users. We will keep this until we make it stable.
        [!] Fixed connecting issue
        [!] Now logged WP users can send message without problem
        [!] Fixed php notice during plugin activation
        [!] Fixed license notifcation encoding
        [!] Fixed avatar overlap to text issue
        [!] Fixed registering scripts to WP (so works better with cache plugins when CX updated into new version)

    Version 1.4.1 - 6 October 2014
        [!] Fixed IE Notification error
        [!] "Posts Page" isn't considered as homepage anymore
        [!] Now the same license key can be rechecked when there is an error
        [!] App token is dynamic now and doesn't affected by WP cache plugins
        [!] Fixed "don't allow cache" issue

    Version 1.4 - 27 September 2014
        [+] Desktop notifications for operators who use Chrome, Safari, Opera or Firefox
        [+] Added German language (Michael Heger)
        [+] Added default company avatar, avatar radius and avatar size options
        [+] Visitors see their messages in simpler balloon
        [+] New shortcode: "cx_btn". Usage: [cx_btn]Chat with us[/cx_btn]
        [+] Display option for Woocommerce products and pages
        [+] Added "show" and "hide" options to homepage display settings
        [+] Compatible with Polylang plugin
        [+] Better working with popular cache plugins when login form is disabled. No confusing with other visitor conversations
        [+] Supports upgrading from LC
        [*] Fixed undefined cnv_id variable when chat offline in front-end
        [*] Deprecated: Message after ending chat
        [!] Cleaned PHP notice in fn.common.php file
        [!] Now administrators notified as well when visitor is online, not only users with "CX Operator" role

    Version 1.3.2 - 30 August 2014
        [!] Fixed wrong curl error message while activating the plugin
        [!] Fixed to including FirebaseLib again on settings page

    Version 1.3.1 - 27 August 2014
        [*] Updates improved
        [!] Fixed wrong display options on categories and 404 pages

    Version 1.3 - 24 August 2014
        [+] Added "email notifications" for operators when visitor logs into chat
        [+] Added visitor's active page url into chat console
        [+] All realtime data can be cleaned and stored to your own database in chat options
        [+] Added Russian language (Elena Prokofieva)
        [+] Added Portuguese/Brazilian language (Leonardo Fontoura)
        [+] Added security rules for Firebase
        [+] Added minimize arrow icon into popup header
        [+] Added default avatar
        [+] Realtime displaying chat button (delay is optional)
        [+] Now there is only one button status (no difference btw online/offline status)
        [*] Now CX uses PHP sessions by default if possible. Otherwise continue to use WP Sessions in database with a new "Clean Sessions" button in chat options
        [*] Keep button minimized after refreshing page
        [*] Normal visitor doesn't connect Firebase to prevent unnecessary connections
        [*] After clicking "End Chat" button, popup minimized instead of showing offline or login form in front-end
        [*] Now chat logs shows 50 items per page
        [*] "Hide when all operators offline" feature removed not to require every web visitor to connect Firebase
        [*] Improved "http_build_query" function for activating the plugin
        [*] Don't listen cmd (mac), ctrl, tab, shift, backspace and alt keys when user writing. It is good when user just surfing around tabs instead of really writing
        [*] Plugin activating shows cURL errors
        [*] Badge removed for better implementation
        [*] Now loads Firebase.js from your own server, not from Firebase CDN
        [*] Icon fonts embedded into CSS
        [*] Firebase.js updated to 1.0.19
        [*] Autosize plugin updated to 1.18.9
        [!] Fixed displaying options for categories and all other types
        [!] Fixed wrong mode displayed when login form disabled! Now showing contact form if all operators offline, not conversation
        [!] Fixed quoting slashes in chat options (added addslashes functions in fn.common.php)
        [!] Fixed disappearing popup after a couple of clicks when no animation selected
        [!] Fixed text link pattern in messages. Now supports full links like http://www.screets.com
        [!] Fixed "End Chat" issue. Now visitor removing from users list in chat console and when operator ends a visitor chat, visitor goes offline immediately
        [!] Fixed bulk deleting in chat logs
        [!] Fixed wrong online mode when all operators offline and login form disabled. Now users who logged in before sees contact form even login form disabled.

    Version 1.2 - 13 June 2014
        [+] Added "User is typing..." notification
        [+] Now login form sent when user click "Enter" instead of clicking "Send" button
        [!] Fixed empty chat settings
        [!] Fixed reconnecting
        [!] Fixed chat logs order
        [!] Stripped slashed from chat logs messages

    Version 1.1.4 - 10 June 2014
        [*] Improved activating CX
        [*] Unnecessary browser logs removed
        [!] Fixed undefined index notices during post/page saving on backend

    Version 1.1.3 - 8 June 2014
        [*] Notifications in chat settings improved for admin users
        [*] Upgrading improved
        [!] Chat logs timestamp is fixed
        [!] Chat logs can be deleted now
        [!] Fixed "Always display homepage" issue
        [!] Fixed redirecting issue on offline button

    Version 1.1.2 - 7 June 2014
        (We had to skip this update because of wrong upload on our servers for auto-upgrading)

    Version 1.1.1 - 3 June 2014
        [*] Visitor's popup auto-opened when operator write new message!
        [!] Allow guests users when there is no login form
        [!] Fixed disappeared chat box issue when "Hide when all operators offline" is checked
        [!] Fixed display options on all post types and pages
        [!] Fixed desktop notification issue on Chrome browser
        [!] Fixed same IP and email problem for all visitors on chat console

    Version 1.1 - 29 May 2014
        [+] Now chat is realtime (Firebase integration)
        [+] Source code is optimized
        [+] Performance improved
        [+] More control added on appearance
        [*] AJAX removed from chat transmissions

    Version 1.0.1 - 23 Jan 2014
        [!] Fixed disconnecting issue

    Version 1.0
        Launch  :)