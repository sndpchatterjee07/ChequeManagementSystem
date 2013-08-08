Steps to be performed:
======================


1) Preparing database - Queries to be executed as 'root'(5.5.12 - MySQL Community Server (GPL)):

    CREATE DATABASE IF NOT EXISTS `cheque_management` /*!40100 DEFAULT CHARACTER SET latin1 */;  


2) Creating the 12 tables - 

      CREATE TABLE IF NOT EXISTS `activity_master` (
        `ACTIVITY_ID` varchar(50) NOT NULL,
        `ACTIVITY_NAME` varchar(50) NOT NULL,
        PRIMARY KEY (`ACTIVITY_ID`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `bank_master` (
        `BANK_NAME` varchar(100) NOT NULL,
        `IFSC_CODE` varchar(11) NOT NULL,
        `BRANCH_NAME` varchar(100) NOT NULL,
        `BRANCH_ADDRESS` varchar(200) NOT NULL,
        `CONTACT_NO` varchar(50) NOT NULL,
        PRIMARY KEY (`IFSC_CODE`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;	


      CREATE TABLE IF NOT EXISTS `cheque_master` (
        `CHEQUE_NO` varchar(50) NOT NULL,
        `IFSC_CODE` varchar(11) NOT NULL,
        `CHEQUE_ISSUE_DATE` date NOT NULL,
        `CHEQUE_AMOUNT` double NOT NULL,
        `TRANSACTION_TYPE` varchar(50) NOT NULL,
        `CHEQUE_STATUS` varchar(50) NOT NULL DEFAULT 'IN PROCESS',
        `ISSUED_TO` varchar(50) DEFAULT NULL,
        `ISSUED_FROM` varchar(50) DEFAULT NULL,
        `REMARKS` varchar(50) DEFAULT NULL,
        `USER_ACCOUNT_NO` varchar(20) NOT NULL,
        `USER_ID` varchar(50) NOT NULL,
        PRIMARY KEY (`CHEQUE_NO`) USING BTREE
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `customer_master_list` (
        `USER_ID` varchar(50) NOT NULL,
        `USER_ACCOUNT_NO` varchar(20) NOT NULL,
        `BALANCE` double NOT NULL,
        `IFSC_CODE` varchar(11) DEFAULT NULL,
        PRIMARY KEY (`USER_ACCOUNT_NO`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `group_master` (
        `GROUP_ID` varchar(50) NOT NULL,
        `GROUP_NAME` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`GROUP_ID`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `permission_master` (
        `ACTIVITY_ID` varchar(50) NOT NULL,
        `GROUP_ID` varchar(50) NOT NULL,
        `WHETHER_GRANTED` varchar(50) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `sundry_info_master` (
        `COMPANY_ID` varchar(50) NOT NULL,
        `COMPANY_NAME` varchar(50) NOT NULL,
        `WHETHER_DEBITOR` varchar(50) DEFAULT NULL,
        `WHETHER_CREDITOR` varchar(50) DEFAULT NULL,
        `RESPONSIBLE_PERSON` varchar(50) NOT NULL,
        `RESPONSIBLE_PERSON_ADDRESS` varchar(150) NOT NULL,
        `RESPONSIBLE_PERSON_NO` varchar(15) NOT NULL,
        `USER_ID` varchar(50) NOT NULL,
        PRIMARY KEY (`COMPANY_ID`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `transaction_master` (
        `TRANSACTION_ID` varchar(50) NOT NULL,
        `TRANSACTION_TYPE` varchar(50) NOT NULL,
        PRIMARY KEY (`TRANSACTION_ID`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



      CREATE TABLE IF NOT EXISTS `user_credit_details_master` (
        `USER_ID` varchar(50) NOT NULL,
        `DATE` date NOT NULL,
        `REFERENCE_ID` varchar(50) NOT NULL,
        `TRANSACTION_TYPE` varchar(50) NOT NULL,
        `CREDIT_AMOUNT` double NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Based on Transaction Type ''Credit'',data will be inserted into this table.';



      CREATE TABLE IF NOT EXISTS `user_debit_details_master` (
        `USER_ID` varchar(50) NOT NULL,
        `DATE` date NOT NULL,
        `REFERENCE_ID` varchar(50) NOT NULL,
        `TRANSACTION_TYPE` varchar(50) NOT NULL,
        `DEBIT_AMOUNT` double NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Based on Transaction Type ''Debit'',data will be inserted into this table.';


      CREATE TABLE IF NOT EXISTS `user_master` (
        `USER_ID` varchar(50) NOT NULL,
        `PASSWORD` varchar(50) NOT NULL,
        `GROUP_ID` varchar(50) NOT NULL,
        `EMAIL` varchar(50) NOT NULL,
        PRIMARY KEY (`USER_ID`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


      CREATE TABLE IF NOT EXISTS `user_transaction_history_master` (
        `REFERENCE_ID` varchar(50) DEFAULT NULL,
        `USER_ID` varchar(50) DEFAULT NULL,
        `VALUE_DATE` date DEFAULT NULL,
        `TRANSACTION_DATE` date DEFAULT NULL,
        `CHEQUE_NO` varchar(50) DEFAULT NULL,
        `DESCRIPTION` varchar(100) DEFAULT NULL,
        `IFSC_CODE` varchar(11) DEFAULT NULL,
        `TRANSACTION_TYPE` varchar(50) DEFAULT NULL,
        `AMOUNT` double DEFAULT NULL,
        `BALANCE` double DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


3) Inserting dummy data:

INSERT INTO cheque_management.group_master(`GROUP_ID`,`GROUP_NAME`) VALUES ('ADMIN','ADMINISTRATOR');

INSERT INTO cheque_management.group_master(`GROUP_ID`,`GROUP_NAME`) VALUES ('CUST','CUSTOMER');

INSERT INTO cheque_management.user_master(`user_id`,`password`,`group_id`,`email`) VALUES ('kkk159','kkk159','admin','admin@gmail.com');

INSERT INTO cheque_management.user_master(`user_id`,`password`,`group_id`,`email`) VALUES ('sandeep','123','cust','sandeep@gmail.com');

INSERT INTO cheque_management.transaction_master(`transaction_id`, `transaction_type`) VALUES ('Db','Debit');

INSERT INTO cheque_management.transaction_master(`transaction_id`, `transaction_type`) VALUES ('Cr','Credit');

INSERT INTO cheque_management.bank_master(`bank_name`, `ifsc_code` , `branch_name` , `branch_address`, `contact_no`) VALUES ('HDFC BANK LTD.','HDFC0001994','PORT BLAIR','HDFC BANK LTD. 201, MAHATMA GANDHI ROAD, JUNGLIGHAT, PORT BLAIR ANDAMAN & NICOBAR  744103','09831073333');

INSERT INTO cheque_management.bank_master(`bank_name`, `ifsc_code` , `branch_name` , `branch_address`, `contact_no`) VALUES ('AXIS BANK LTD','UTIB0001560','DIGLIPUR','SUBHAS GRAM, OPP. GOVT SECONDARY SCHOOL, PS.: DIGLIPUR, DIST. NORTH & MIDDLE ANDAMAN, ANDAMAN & NICOBAR, PIN 744202','(03192) 272478');

INSERT INTO cheque_management.bank_master(`bank_name`, `ifsc_code` , `branch_name` , `branch_address`, `contact_no`) VALUES ('BANK OF BARODA','BARB0PBLAIR','PORT BLAIR, ANDAMAN','BJP BHAVAN  1ST FLOOR, SUPPLY LINE, M.G. ROAD(MIDDLE POINT) PORT BLAIR 744 101 ANDAMAN & NICOBAR ISLAND','03192-244462 TELFAX ,239945');

INSERT INTO cheque_management.bank_master(`bank_name`, `ifsc_code` , `branch_name` , `branch_address`, `contact_no`) VALUES ('CANARA BANK','CNRB0001185','PORT BLAIR, ANDAMAN','Krishna House, Aberdeen Bazar, Port Blair 744 104','03192-233085');


For any queries/feedbacks/suggestions,drop a mail to sndpchatterjee07@gmail.com.
