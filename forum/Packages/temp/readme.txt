This patch will provide PHP 7 compatiblity and HTTPS, as well as some security and bug fixes.

Changelog
=========
[list]
[li]Updating session handlers[/li]
[li]Adding HTTPS
[list]
[li]fetch_web_data now uses cURL, falling back to sockets[/li]
[li]Ported image proxy support from SMF 2.1[/li]
[li]Also added HTTPS for avatars[/li]
[/list]
[/li]
[li]Added a simple exception handler[/li]
[li]Check session while logging in[/li]
[li]Sanitize some fields to help guard against XSS[/li]
[li]Validate email addresses with PHP's filter method[/li]
[li]Fix search highlighting to not mangle/expose some HTML[/li]
[li]Fix password acceptance when special characters were used in UTF-8[/li]
[li]Correct some random logic errors in the profile area[/li]
[li]Use ampersands instead of semi-colons for PayPal's return link[/li]
[li]Fix sending multiple MIME-Version headers in notification mail[/li]
[li]Fix sending multiple Content-Type headers in all requests[/li]
[/list]

Special thanks:
[list]
[li]bjornforum[/li]
[li]Intit[/li]
[li]margarett[/li]
[li]mktek[/li]
[li]NLNico[/li]
[li]Q[/li]
[li]Suki[/li]
[li]WadaNon[/li]
[li]Z217[/li]
[/list]

This release requires at least PHP 5.3 to function. Most hosts should have it or something newer. You can check which version of PHP that you are running by visiting the "Support and Credits" section of the Administration Center.

You can enable the new image proxy feature at [i]Admin -> Configuration -> Server Settings -> General[/i]
