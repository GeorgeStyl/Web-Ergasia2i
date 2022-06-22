# 2η Εργασία

# **Προτινόμενοι κανόνες χρήσης του "main" branch**

- Push στο main branch όποτε έχουμε τελειώσει οριστικά με ένα file

  - Το report καλό θα είναι να το συμπληρώνουμε κάθε φορά που θα ασχολούμαστε και θα τελειώνουμε ένα file της εργασίας μας. Και μετά, push στο main branch
  - Καλή τακτική θα ήταν να έχουμε και ένα προσωπικό report όπου θα γραφουμε υπό-reports για κάθε τι που κάναμε. Ώστε να μη μας ξεφύγει κάτι

  ΣΤΟ mySQL το mail δε παιρνει κενα

  - ISACTIVE: energos = 1 / 0

# ΤΙ ΜΕΝΕΙ:
 - ΝΑ ΦΤΙΑΧΤΙΥΝ ΤΑ ΜΕΝΟΥ ΣΩΣΤΑ
 - ΝΑ ΓΙΝΕΙ ΤΟ LOGOUT
 - ΝΑ ΓΙΝΕΙ ΣΩΣΤΑ Η QUIZ ΟΠΩΣ ΤΗ ΖΗΤΑΕΙ Ο ΚΑΘΗΓΗΤΗΣ  ΤΙΣ ΕΡΩΤΗΣΕΙΣ ΝΑ ΤΙΣ ΠΑΙΡΝΕΙ ΑΠΟ ΤΗ ΒΑΣΗ)
 - ΝΑ ΦΤΙΑΧΤΕΙ Η ΣΕΛΙΔΑ ΠΟΥ Ο ΧΡΗΣΤΗΣ ΥΠΟΒΑΛΛΕΙ ΕΡΩΤΗΣΗ ΓΙΑ ΝΑ ΠΡΟΣΤΕΘΕΙ ΣΤΙΣ ΕΡΩΤΗΣΕΙΣ
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
    
    
Πίνακας Διαθέσιμων Ερωτήσεων:  
CREATE TABLE `questlist` (  
  `qid` int NOT NULL AUTO_INCREMENT,  
  `QText` mediumtext NOT NULL,			-- το κείμενο της ερωτησης  
  `QType` varchar(15) NOT NULL,			-- ενα από truefalse, filltext, multiplechoice, singlechoice  
  `QDiffLevel` varchar(50) NOT NULL,	-- ενα από easy, medium, hard  
  `QApproved` int NOT NULL DEFAULT '0',	-- 0: for approval, 1=approved, 2=rejected  
  `QApprovedBy` int NULL DEFAULT '0',	-- userid of user approved/rejected  
  `QApprovedOn` datetime NULL,  
  `QIsActive` int NOT NULL DEFAULT '1',	  -- 1=active, 0=non active  
  `QPostedBy` int NOT NULL,				        -- userid of user posted  
  `QPostedOn` datetime NOT NULL, 
  PRIMARY KEY (`qid`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;  
  
ALTER TABLE `teliki_ergasia`.`questlist`   
CHANGE COLUMN `QApprovedBy` `QApprovedBy` INT NULL DEFAULT '0' ,  
CHANGE COLUMN `QApprovedOn` `QApprovedOn` DATETIME NULL ;  
  
τύπος truefalse	=> radio buttongroup or single <select>  
τύπος filltext	=> input type="text"  
τύπος multiplechoice => <select  multiple> or fieldset of checkboxes  
τύπος singlechoice => radio buttongroup or single <select>  
  
Πίνακας απαντήσεων των παραπάνω διαθέσιμων ερωτήσεων  
CREATE TABLE `qanswerslist` (
  `qid` int NOT NULL,						-- το id της ερώτησης του πίνακα `questlist`  
  `qanswid` int NOT NULL AUTO_INCREMENT,	-- (auto) αυξων id της απάντησης  
  `AnwerText` varchar(150) NOT NULL,		-- κείμενο απάντησης  
  `RightAnswer` int NOT NULL DEFAULT '0',  -- 0: λανθασμενη απάντηση, 1: σωστή απάντηση  
  PRIMARY KEY (`qanswid`),  
  KEY `PK_QAnswerList` (`qid`,`qanswid`)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;  
  
  
  
INSERT INTO `teliki_ergasia`.`questlist`
(`QText`,
`QType`,
`QDiffLevel`,
`QPostedBy`,
`QPostedOn`,
`QApproved`
)
VALUES
(
'Το bitcoin είναι ένα ψηφιακό νόμισμα και δεν εκδίδεται απο κάποια τράπεζα',
'truefalse',
'medium',
1,
Now(),
0
);  
  
RightAnswer :: 1=yes, 0=No  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (1,'Σωστό ', 1);  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (1,'Λάθος ', 0);  
  
Ερώτηση 2:Με ποίον τρόπο συνδέεται το Ether με το Ethereum?  
  
1)Καμία, το Ether η αλλιώς αιθέρας χρησιμοποιείται στην οργανική χημεία  
2)Το Ether είναι κρυπτονόμισμα και το Ethereum ειναι μία blockhain πλατφόρμα  
3)Το Ethereum είναι κρυπτονόμισμα και το Ether είναι μία blockchain πλατφόρμα  
4)Και τα 2 είναι κρυπτονομίσματα αλλά το Ether είναι πιό ακριβό από το Ethereum  
  
INSERT INTO `teliki_ergasia`.`questlist`
(`QText`,
`QType`,
`QDiffLevel`,
`QPostedBy`,
`QPostedOn`,
`QApproved`
)
VALUES
(
'Με ποίον τρόπο συνδέεται το Ether με το Ethereum?',
'singlechoice',
'medium',
1,
Now(),
0
);  
==> id = 3  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (3,'Καμία, το Ether η αλλιώς αιθέρας χρησιμοποιείται στην οργανική χημεία', 0);  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (3,'Το Ether είναι κρυπτονόμισμα και το Ethereum ειναι μία blockhain πλατφόρμα', 1);  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (3,'Το Ethereum είναι κρυπτονόμισμα και το Ether είναι μία blockchain πλατφόρμα', 0);  
INSERT INTO `teliki_ergasia`.`qanswerslist`
(`qid`,`AnwerText`,`RightAnswer`) VALUES (3,'Και τα 2 είναι κρυπτονομίσματα αλλά το Ether είναι πιό ακριβό από το Ethereum', 0);  
  
-- QType	truefalse, filltext, multiplechoice, singlechoice  
-- QDiffLevel	easy, medium, hard  

