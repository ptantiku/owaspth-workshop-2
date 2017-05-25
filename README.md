# owaspth-workshop-2

## Setup

1. using a tool to copy file via ssh or scp to web server
  - host: owaspth.securitylab.ninja
  - protocol: ssh
  - port: 22
2. copy all files here into your directory in the server (e.g. /home/team1/html)
3. accessing your site with 
  - team1: http://owaspth.securitylab.ninja:1001/
  - team2: http://owaspth.securitylab.ninja:1002/
  - team3: http://owaspth.securitylab.ninja:1003/
  - team4: http://owaspth.securitylab.ninja:1004/
  - team5: http://owaspth.securitylab.ninja:1005/
  - team6: http://owaspth.securitylab.ninja:1006/
  - team7: http://owaspth.securitylab.ninja:1007/
  - team8: http://owaspth.securitylab.ninja:1008/
  - team9: http://owaspth.securitylab.ninja:1009/
  - team10: http://owaspth.securitylab.ninja:1010/

## Test
Go to your /test.php on your website to test

e.g. http://owaspth.securitylab.ninja:1001/test.php

## Attacker side
The attacker has setup a web server for recording all GET requests.

**To record:**
http://attacker.securitylab.ninja/record/123781273981723123

**To view:**
http://attacker.securitylab.ninja/

## Resources
- [OWASP XSS Filter Evasion Cheat Sheet](https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet)
- [OWASP XSS Prevention Cheat Sheet](https://www.owasp.org/index.php/XSS_%28Cross_Site_Scripting%29_Prevention_Cheat_Sheet)
- [OWASP DOM-based XSS Prevention Cheat Sheet](https://www.owasp.org/index.php/DOM_based_XSS_Prevention_Cheat_Sheet)
- [PHP.earth Security](https://php.earth/doc/security/intro#cross-site-request-forgery-xsrfcsrf)
