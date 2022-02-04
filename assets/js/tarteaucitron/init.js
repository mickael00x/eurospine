
	const currentLanguage = document.querySelector("html").getAttribute("lang");
	window.tarteaucitronForceLanguage = currentLanguage;
	
        tarteaucitron.init({
		"privacyUrl": "/terms-and-conditions/", /* Privacy policy url */

		"hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
		"cookieName": "tarteaucitron", /* Cookie name */

		"orientation": "bottom", /* Banner position (top - bottom - middle - popup) */

		"groupServices": false, /* Group services by category */

		"showAlertSmall": false, /* Show the small banner on bottom right */
		"cookieslist": true, /* Show the cookie list */

		"showIcon": true, /* Show cookie icon to manage cookies */
		// "iconSrc": "", /* Optionnal: URL or base64 encoded image */
		"iconPosition": "BottomRight", /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

		"adblocker": false, /* Show a Warning if an adblocker is detected */

		"DenyAllCta" : true, /* Show the deny all button */
		"AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
		"highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */

		"handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

		"removeCredit": false, /* Remove credit link */
		"moreInfoLink": true, /* Show more info link */
		"useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */

		//"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

		"readmoreLink": "", /* Change the default readmore link pointing to tarteaucitron.io */

		"mandatory": true /* Show a message about mandatory cookies */
	});
	tarteaucitron.user.facebookpixelId = '850795931965588';
    tarteaucitron.user.linkedininsighttag = '2483929';
	(tarteaucitron.job = tarteaucitron.job || []).push('facebookpixel', "linkedininsighttag");