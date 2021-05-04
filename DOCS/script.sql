create sequence USER_ID_SEQ
    maxvalue 999999999
/

create sequence CHATS_ID_SEQ
    maxvalue 999999999
/

create sequence CLIENTS_ID_SEQ
    maxvalue 999999999
/

create sequence DOCUMENTS_ID_SEQ
    maxvalue 999999999
/

create sequence MEETINGS_ID_SEQ
    maxvalue 999999999
/

create sequence PAYMENTS_ID_SEQ
    maxvalue 999999999
/

create sequence REPORTS_ID_SEQ
    maxvalue 999999999
/

create sequence REVIEWS_ID_SEQ
    maxvalue 999999999
/

create sequence CASE_ID_SEQ
    maxvalue 999999999
/

create table USERS
(
    ID       NUMBER not null
        primary key,
    PP       VARCHAR2(500),
    FULLNAME VARCHAR2(100),
    USERNAME VARCHAR2(50),
    EMAIL    VARCHAR2(50),
    PHONE    VARCHAR2(50),
    PASS     VARCHAR2(50),
    NID      VARCHAR2(50),
    DOB      VARCHAR2(50),
    GENDER   VARCHAR2(50),
    ADDRESS  VARCHAR2(100),
    CITY     VARCHAR2(50),
    STATE    VARCHAR2(50),
    ZIP      VARCHAR2(50),
    TYPE     VARCHAR2(50)
)
/

create trigger RESTRICTEDPROFILEUPDATE
    before update
    on USERS
begin
    if (to_char(sysdate, 'DY') in ('FRI', 'SAT', 'SUN')) then
        raise_application_error(-20222, 'Profile Cannot Be Updated on Friday, Saturday or Sunday!');
    end if;
end;
/

create table CASES
(
    ID               NUMBER not null
        primary key,
    CASE_TITLE       VARCHAR2(100),
    CASE_DESCRIPTION VARCHAR2(500),
    DATE_ADDED       VARCHAR2(50),
    HEARING_DATE     VARCHAR2(50),
    CASE_STATUS      VARCHAR2(50),
    DOCUMENT         VARCHAR2(500),
    CLIENT_ID        NUMBER
        constraint CASES_USERS_ID_FK_2
            references USERS
                on delete cascade,
    COMPLAINANT_ID   NUMBER
        constraint CASES_USERS_ID_FK_3
            references USERS
                on delete cascade,
    LAWYER_ID        NUMBER
        constraint CASES_USERS_ID_FK
            references USERS
                on delete cascade
)
/

create trigger RESTRICTEDCASE
    before insert or update
    on CASES
begin
    raise_application_error(-20223, 'All Cases are Locked By Admin!');
end;
/

create table CLIENTS
(
    ID        NUMBER not null
        primary key,
    CLIENT_ID NUMBER
        constraint CLIENTS_USERS_ID_FK
            references USERS,
    LAWYER_ID NUMBER
        constraint CLIENTS_USERS_ID_FK_2
            references USERS
)
/

create trigger RESTRICTEDCLIENT
    before insert or update
    on CLIENTS
begin
    raise_application_error(-20225, 'Client Hiring is Locked By Admin!');
end;
/

create table DOCUMENTS
(
    ID          NUMBER not null
        primary key,
    DOCUMENT    VARCHAR2(500),
    VIEWER_ID   NUMBER
        constraint DOCUMENTS_USERS_ID_FK
            references USERS,
    UPLOADER_ID NUMBER
        constraint DOCUMENTS_USERS_ID_FK_2
            references USERS
)
/

create table MEETINGS
(
    ID                  NUMBER not null
        primary key,
    ATTANDEE_NAME       VARCHAR2(50),
    ORGANIZER_NAME      VARCHAR2(50),
    MEETING_TITLE       VARCHAR2(100),
    MEETING_DESCRIPTION VARCHAR2(500),
    MEETING_TIME        VARCHAR2(50),
    ATTANDEE_ID         NUMBER
        constraint MEETINGS_USERS_ID_FK
            references USERS,
    ORGANIZER_ID        NUMBER
        constraint MEETINGS_USERS_ID_FK_2
            references USERS
)
/

create table PAYMENTS
(
    ID           NUMBER not null
        primary key,
    DUE          VARCHAR2(50),
    PAID         VARCHAR2(50),
    BALANCE      VARCHAR2(50),
    DUE_DATE     VARCHAR2(50),
    PAYMENT_DATE VARCHAR2(50),
    PAYER_ID     NUMBER
        constraint PAYMENTS_USERS_ID_FK
            references USERS,
    RECEIVER_ID  NUMBER
        constraint PAYMENTS_USERS_ID_FK_2
            references USERS
)
/

create trigger RESTRICTEDPAYMENT
    before insert or update
    on PAYMENTS
begin
    raise_application_error(-20223, 'All Payments are Locked By Admin!');
end;
/

create table REPORTS
(
    ID             NUMBER not null
        primary key,
    MONTHLY        VARCHAR2(500),
    WEEKLY         VARCHAR2(500),
    TRANSACTIONS   VARCHAR2(500),
    DATE_GENERATED VARCHAR2(50),
    GENERATOR_ID   NUMBER
        constraint REPORTS_USERS_ID_FK
            references USERS
)
/

create table REVIEWS
(
    ID          NUMBER not null
        primary key,
    REVIEW      VARCHAR2(500),
    RATING      VARCHAR2(50),
    REVIEWER_ID NUMBER
        constraint REVIEWS_USERS_ID_FK_2
            references USERS,
    REVIEWEE_ID NUMBER
        constraint REVIEWS_USERS_ID_FK
            references USERS
)
/

create table CHATS
(
    ID          NUMBER not null
        primary key,
    MESSAGE     VARCHAR2(500),
    SENDER_ID   NUMBER
        constraint CHATS_USERS_ID_FK
            references USERS,
    RECEIVER_ID NUMBER
        constraint CHATS_USERS_ID_FK_2
            references USERS
)
/

create function IsReviewDone(ReviewerId REVIEWS.REVIEWER_ID%type, RevieweeId REVIEWS.REVIEWEE_ID%type)
    return boolean
    is
    CountReview number(10);
Begin
    SELECT COUNT(*) INTO CountReview FROM REVIEWS WHERE REVIEWER_ID = ReviewerId AND REVIEWEE_ID = RevieweeId;
    IF CountReview > 0 THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
end;
/

create procedure AddReview(Review in REVIEWS.REVIEW%type, Rating in REVIEWS.RATING%type,
                           ReviewerId in REVIEWS.REVIEWER_ID%type, RevieweeId in REVIEWS.REVIEWEE_ID%type)
    is
Begin
    IF IsReviewDone(ReviewerId, RevieweeId) THEN
        raise_application_error(-20201, 'Review Already Done!');
    ELSE
        INSERT INTO REVIEWS(ID, REVIEW, RATING, REVIEWER_ID, REVIEWEE_ID)
        VALUES (REVIEWS_ID_SEQ.NEXTVAL, Review, Rating, ReviewerId, RevieweeId);
    END IF;
end;
/

create PROCEDURE ClientPayment(PayAm IN PAYMENTS.PAID%type, PayDate IN PAYMENTS.PAYMENT_DATE%type,
                               PId IN PAYMENTS.ID%type)
    IS
    BALANCELOC PAYMENTS.BALANCE%type;
    DUELOC     PAYMENTS.DUE%type;
BEGIN
    SELECT DUE INTO DUELOC FROM PAYMENTS WHERE ID = PId;
    BALANCELOC := DUELOC - PayAm;
    IF (BALANCELOC < 0) THEN
        raise_application_error(-20202, 'Please Pay Exact or Less Amount than Due!');
    ELSE
        UPDATE PAYMENTS SET DUE=BALANCELOC, PAID=PAID + PayAm, BALANCE=BALANCELOC, PAYMENT_DATE=PayDate WHERE ID = PId;
    END IF;
END;
/

create PROCEDURE DeleteUser(UserId IN USERS.ID%type)
    IS
BEGIN
    DELETE FROM CASES WHERE CLIENT_ID = UserId OR COMPLAINANT_ID = UserId OR LAWYER_ID = UserId;
    DELETE FROM CHATS WHERE RECEIVER_ID = UserId OR SENDER_ID = UserId;
    DELETE FROM CLIENTS WHERE LAWYER_ID = UserId OR CLIENT_ID = UserId;
    DELETE FROM DOCUMENTS WHERE UPLOADER_ID = UserId OR VIEWER_ID = UserId;
    DELETE FROM MEETINGS WHERE ATTANDEE_ID = UserId OR ORGANIZER_ID = UserId;
    DELETE FROM PAYMENTS WHERE RECEIVER_ID = UserId OR PAYER_ID = UserId;
    DELETE FROM REPORTS WHERE GENERATOR_ID = UserId;
    DELETE FROM REVIEWS WHERE REVIEWEE_ID = UserId OR REVIEWER_ID = UserId;
    DELETE FROM USERS WHERE ID = UserId;
END;
/

create PROCEDURE SearchLawyer(stateDiv IN USERS.STATE%type, rate IN REVIEWS.RATING%type, keyW varchar,
                              REFCUR OUT SYS_REFCURSOR)
    IS
BEGIN
    OPEN REFCUR FOR SELECT *
                    FROM USERS
                    WHERE USERS.ID IN (SELECT U.ID
                                       FROM USERS U,
                                            REVIEWS R
                                       WHERE U.ID = R.REVIEWEE_ID
                                         AND R.RATING <= rate
                                       GROUP BY U.ID
                                       HAVING AVG(R.RATING) IN (SELECT AVG(R.RATING)
                                                                FROM USERS U,
                                                                     REVIEWS R
                                                                WHERE U.ID = R.REVIEWEE_ID
                                                                  AND R.RATING <= rate
                                                                GROUP BY U.ID))
                      AND STATE = stateDiv
                      AND FULLNAME LIKE keyW || '%';
END;
/

create PROCEDURE SearchClient(stateDiv IN USERS.STATE%type, balance IN PAYMENTS.BALANCE%type, keyW varchar,
                              REFCUR OUT SYS_REFCURSOR)
    IS
BEGIN
    IF balance > 0 THEN
        OPEN REFCUR FOR SELECT DISTINCT U.*
                        FROM USERS U,
                             PAYMENTS P
                        WHERE U.ID = P.PAYER_ID
                          AND U.TYPE = 'client'
                          AND U.STATE = stateDiv
                          AND P.BALANCE > 0
                          AND U.FULLNAME LIKE keyW || '%';
    ELSE
        OPEN REFCUR FOR SELECT DISTINCT U.*
                        FROM USERS U,
                             PAYMENTS P
                        WHERE U.ID = P.PAYER_ID
                          AND U.TYPE = 'client'
                          AND U.STATE = stateDiv
                          AND P.BALANCE = 0
                          AND U.FULLNAME LIKE keyW || '%';
    END IF;
END;
/


