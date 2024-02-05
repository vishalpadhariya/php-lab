#  Taleo API

>  ***TALEO_LOGIN_API*** :  https://phe.tbe.taleo.net/phe01/ats/api/v1/login
> 
> ***GET_TALEO_DATA_API*** : https://phe.tbe.taleo.net/phe01/ats/api/v1/object/requisition/search?openedDate_from=1970-01-01&status=2
> 
> ***LOGOUT_TALEO_API*** : https://phe.tbe.taleo.net/phe01/ats/api/v1/logout

##  Crendentials

> ***TALEO_COMPANY_CODE***
> 
> ***TALEO_USERNAME***
> 
> ***TALEO_PASSWORD***
> 
> You can find above crendentials after login from [Taleo Login](https://tbe.taleo.net/login/) or [Taleo Dispatcher Login](https://phe.tbe.taleo.net/dispatcher/login.jsp) .

  

##  How to use

`getAuthToken()` working as per it's name to retrive the token from the taleo api.
`getCounterOfJob()` use to get total number of jobs.
`getTaleoData()` use to fetch all taleo jobs.
`logout()` use to logout from taleo api.
