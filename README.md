# 2η Εργασία

# **Προτινόμενοι κανόνες χρήσης του "main" branch**

- Push στο main branch όποτε έχουμε τελειώσει οριστικά με ένα file

  - Το report καλό θα είναι να το συμπληρώνουμε κάθε φορά που θα ασχολούμαστε και θα τελειώνουμε ένα file της εργασίας μας. Και μετά, push στο main branch
  - Καλή τακτική θα ήταν να έχουμε και ένα προσωπικό report όπου θα γραφουμε υπό-reports για κάθε τι που κάναμε. Ώστε να μη μας ξεφύγει κάτι

  ΣΤΟ mySQL το mail δε παιρνει κενα

  - ISACTIVE: energos = 1 / 0

# **Αλλαγες στα ηδη υπαρχον files**

## sign-up.html

- form action = <form action=**"sign-up.html" method="post"** style="border:1px solid #ccc">
- gender = <input type="radio" name="Gender" **id="male" value="M"**>Άντρας  
   <input type="radio" name="Gender" **id="female" value="F"**>Γυναίκα
- <select name="Day" id="day"> <option value=**"01"**>1</option>
- <select name="month" id="month"> = <option value=**"01"**>Ιανουάριος</option>
- all php code from sign-up.php moved in this page, at the top. This pages's form action calls the same page at post

## sign-up.php --- DISCONTINUED .... ALL PHP CODE MOVED TO THE TOP OF sign-up.html !!

- uses PHP SESSION if user marked remember me=yes
- redirects user to quiz.php (not quiz.html - change) if rememberme  
  else redirects user to login.html

## login.php --- DISCONTINUED .... ALL PHP CODE MOVED TO THE TOP OF login.html !!

## login.html <form action=**"login.html" method="post"** style="border:1px solid #ccc">

- all php code from login.php moved at the top of the login.html
- login.php DISCONTINUED
- this page's form action points to itself so the form posts the data to this page

# .htaccess file in project's directory where .html files exists and that must be treeted as .php for embeded php code (sessions)

## quiz.php added to replace quiz.html in order to support the php session

## index.html

-- changed quiz link to point to quiz.php instead quiz.html  
 -- !!! TODO:: change quiz link to point to quiz.html (see the above point) !!!

## TODO:

- form validation (javascript) in sign-up.html for required fields. (Done)
- logout page if user is loggedin (logout.html)
- create score on quiz for every user (included guests)
- create a profile section on menu with icon
- create a profile settings page
