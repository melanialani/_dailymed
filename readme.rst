###################
What is it
###################

Provides users with access to current Structured Product Language (SPL) information about marketed drugs. The data provided by this service is the most recent provided to the FDA. Users can query this RESTful service using a variety of parameters, including prescription or over the counter, human or animal drugs, drug name, drug imprint data, and National Drug Code (NDC). This free service returns data as XML or JSON based on user specificaiton.

*******************
Server Requirements
*******************

Have xampp installed and phpmyadmin working correctly

************
Installation
************

Just copy and paste it into your htdocs folder of xampp and dump the database.

*********
Example of XML Request
*********

-  `http://localhost/_dailymed/index.php/api/drug/ndc?code=59535-3001 <http://localhost/_dailymed/index.php/api/drug/ndc?code=59535-3001>`_
-  `http://localhost/_dailymed/index.php/api/drug/diagnosis?code=20035 <http://localhost/_dailymed/index.php/api/drug/diagnosis?code=20035>`_
-  `http://localhost/_dailymed/index.php/api/drug/procedure?code=8093 <http://localhost/_dailymed/index.php/api/drug/procedure?code=8093>`_
-  `http://localhost/_dailymed/index.php/api/drug/brand?name=lam <http://localhost/_dailymed/index.php/api/drug/brand?name=lam>`_
-  `http://localhost/_dailymed/index.php/api/drug/generic?name=Midazolam <http://localhost/_dailymed/index.php/api/drug/generic?name=Midazolam>`_

*********
Example of JSON Request
*********

-  `http://localhost/_dailymed/index.php/api/drug/ndc?code=59535-3001 <http://localhost/_dailymed/index.php/api/drug/ndc?code=59535-3001>`_
-  `http://localhost/_dailymed/index.php/api/drug/diagnosis?code=20035 <http://localhost/_dailymed/index.php/api/drug/diagnosis?code=20035>`_
-  `http://localhost/_dailymed/index.php/api/drug/procedure?code=8093 <http://localhost/_dailymed/index.php/api/drug/procedure?code=8093>`_
-  `http://localhost/_dailymed/index.php/api/drug/brand?name=lam <http://localhost/_dailymed/index.php/api/drug/brand?name=lam>`_
-  `http://localhost/_dailymed/index.php/api/drug/generic?name=Midazolam <http://localhost/_dailymed/index.php/api/drug/generic?name=Midazolam>`_
