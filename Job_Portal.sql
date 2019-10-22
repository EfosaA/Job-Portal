DROP DATABASE IF EXISTS job_portal;
CREATE DATABASE job_portal;
USE job_portal;

CREATE TABLE job_seeker (
	seeker_id 		INT 			PRIMARY KEY 	NOT NULL,
    first_name		VARCHAR(25)								,
    last_name		VARCHAR(25)								,
    age				INT										,
    gender   		VARCHAR(20)								,
    birthday    	DATE 									,
    email_address 	VARCHAR(45)						NOT NULL,
    password 		VARCHAR(25)						NOT NULL,
    resume			VARCHAR(100)							
);

CREATE TABLE recruiter (

	employer_id		INT 			PRIMARY KEY		NOT NULL,
    company_id		INT								NOT NULL,
    first_name		VARCHAR(25)								,
    last_name		VARCHAR(25)						     	,
    email_address	VARCHAR(45)						NOT NULL,
    password		VARCHAR(25)						NOT NULL,

    
    CONSTRAINT company_fk_recruiter
		FOREIGN KEY (company_id)
        REFERENCES company (company_id)

);

CREATE TABLE company (
	company_id 				INT			PRIMARY KEY		 NOT NULL,
    company_name			VARCHAR(45)	

);

CREATE TABLE jobs (
    job_id			INT 			 PRIMARY KEY 		 NOT NULL,
    job_name		VARCHAR(45)                                  ,
    experience   	INT											 ,
    job_status		VARCHAR(10)									 ,
    application_due DATE   										 ,
    street_address 	VARCHAR(100)								 ,
    city 			VARCHAR(45)									 ,
    state			VARCHAR(25)									 ,
    job_description	VARCHAR(100)							     ,
    company_id		INT									 NOT NULL,
    salary			INT 										 ,
    
	CONSTRAINT company_fk_jobs
		FOREIGN KEY (company_id)
        REFERENCES company (company_id)
		

);

CREATE TABLE applications (
	application_id			INT 					PRIMARY KEY,
    job_id	  				INT 							   ,
    seeker_id				INT 							   ,
	applied_date			DATE							   ,
    
    CONSTRAINT applications_fk_jobs
		FOREIGN KEY (job_id)
        REFERENCES jobs (job_id),
        
	CONSTRAINT applications_fk_job_seeker
		FOREIGN KEY (seeker_id)
        REFERENCES job_seeker (seeker_id)



);










