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


