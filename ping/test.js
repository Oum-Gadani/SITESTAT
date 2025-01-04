const tcpPing = require('tcp-ping');
const nodemailer = require('nodemailer');
const mailtran = require('./mailTran');

const mysql = require('mysql');
const connection = require('./connection');

var getSites = "select * from sites;";

connection.query(getSites,function(error,results,fields){
    if(error) throw error;
    n=results.length;
    for(var i=0;i<n;i++)
    {
        let site=results[i].site;
        let port=results[i].port;
        tcpPing.probe(site,port,function(err,available)
        {
            if(err) throw err;
            if(available)
            {
                tcpPing.ping({address:site},function(err,data)
                {
                    if(err)throw err;
                    
                    console.log(data.max);
                    console.log("-----------------------------");
                })
                
            }
            if(!available)
            {
                console.log(site + " is down" );
            }

        });
        
    }
});



/*function siteStat()
{
    sites.forEach(function(host){
        tcpPing.ping({ address: host }, function(err, data) {
            console.log(data);
        });
    });
}
siteStat();
*/