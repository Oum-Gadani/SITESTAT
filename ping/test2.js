const tcpPing = require('tcp-ping');
const nodemailer = require('nodemailer');
const mailtran = require('./mailTran');

const mysql = require('mysql');
const connection = require('./connection');

var getSites = "select id from sites;";

connection.query(getSites,function(error,results,fields){
    n=results.length;
    if(error) throw error;
    for(i=0;i<n;i++)
    {
        console.log(results[i].id);
        console.log("--------");
    }
    
});