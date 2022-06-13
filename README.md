# 2η Εργασία

# **Προτινόμενοι κανόνες χρήσης του "main" branch**
* Push στο main branch όποτε έχουμε τελειώσει οριστικά με ένα file
  * Το report καλό θα είναι να το συμπληρώνουμε κάθε φορά που θα ασχολούμαστε και θα τελειώνουμε ένα file της εργασίας μας. Και μετά, push στο main branch
  * Καλή τακτική θα ήταν να έχουμε και ένα προσωπικό report όπου θα γραφουμε υπό-reports για κάθε τι που κάναμε. Ώστε να μη μας ξεφύγει κάτι
  



  ΣΤΟ mySQL το mail δε παιρνει κενα
  - ISACTIVE: energos = 1 / 0


# **Αλλαγες στα ηδη υπαρχον files**
## sign-up.html
  - form action =   <form action=**"sign-up.php" method="post"** style="border:1px solid #ccc">  
  - gender = <input type="radio" name="Gender" **id="male" value="M"**>Άντρας  
             <input type="radio" name="Gender" **id="female" value="F"**>Γυναίκα  
  - <select name="Day" id="day"> <option value=**"01"**>1</option>  
  - <select name="month" id="month"> = <option value=**"01"**>Ιανουάριος</option> 
  
## sign-up.php  
  - uses PHP SESSION if user marked remember me=yes  
  - redirects user to quiz.php  (not quiz.html - change) if rememberme  
    else redirects user to login.html  
  
## login.html <form action=**"login.php" method="post"** style="border:1px solid #ccc">  

## all pages that require a loggedin user, such as quiz should be changed to .php instead of .html in order to use the session functionality of php  

## quiz.php  added to replace quiz.html in order to support the php session  

## index.html changed quiz link to point to quiz.php instead quiz.html  

## TODO: form validation (javascript) in sign-up.html for required fields.  


  

   