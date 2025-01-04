const tcpPing = require('tcp-ping');
const hbs = require('nodemailer-express-handlebars');
var flg=false;
var i,n;
var datetime = require('node-datetime');
const mailtran = require('./mailTran');
const path = require('path');
const mysql = require('mysql');
const nodemailer = require('nodemailer');
var transporter = nodemailer.createTransport(
    {
        port: mailtran.mtPort,
        service: mailtran.mtService,
        auth:{
            user: mailtran.mtUser,
            pass: mailtran.mtPass
        }
    }
);

const connection = require('./connection');
const sites = require('../../../../nodejs code/FinalAdvPing/sites');
var getSites = "select * from sites;";

function getTimeRemaining(endtime,starttime)
{
    var total = Date.parse(endtime) - Date.parse(starttime);
    var seconds = Math.floor( (total/1000) % 60 );
    var minutes = Math.floor( (total/1000/60) % 60 );
    var hours = Math.floor( (total/(1000*60*60)) % 24 );
    var days = Math.floor( total/(1000*60*60*24) );
  
    var finalTi =  'Total Time Down = Days : '+ days + ' Hrs: ' + hours + ' Minutes: ' + minutes + ' Seconds: ' + seconds;
    return [finalTi,days,hours,minutes,seconds];
}
function sendDownMail(mail,time,site,port)
{
    let st = site + ":" + port;
    let reciever = mail;
    let formatted1 = time;
    let handlebarOptions1 = 
    {
        viewEngine:
        {
            partialsDir: path.resolve('D:/wamp64/www/Project/views'),
            defaultLayout: false
        },
        viewPath: path.resolve('D:/wamp64/www/Project/views')
    };
    transporter.use('compile',hbs(handlebarOptions1))
    var mailOptions1 = 
    {
        from: mailtran.mtUser,
        to: reciever,
        subject: mailtran.mtSubDn,
        template: 'status',
        context:
        {
            host: st,
            DtTi: formatted1,
            stat: mailtran.mtStatDwn,
            tiDwn:''
        }
    }
    transporter.sendMail(mailOptions1, function(error, info){
        if(error){
            return console.log(error);
        }
        console.log('Message sent successfully, Host ' + st + ' DOWN . Info. : ' + info.response);
    });
}

function sendUpMail(mail,upTime,ttlTime,site,port)
{
    let st = site + ":" + port;
    let reciever = mail;
    let formatted2 = upTime;
    let totTime = ttlTime;
    let handlebarOptions2 = 
    {
        viewEngine:
        {
            partialsDir: path.resolve('D:/wamp64/www/Project/views'),
            defaultLayout: false
        },
        viewPath: path.resolve('D:/wamp64/www/Project/views')
    };
    transporter.use('compile',hbs(handlebarOptions2))
    var mailOptions2 = 
    {
        from: mailtran.mtUser,
        to: reciever,
        subject: mailtran.mtSubUp,
        template: 'status',
        context:
        {
            host: st,
            DtTi: formatted2,
            stat: mailtran.mtStatUp,
            tiDwn:totTime
        }
    }
    transporter.sendMail(mailOptions2, function(error, info){
        if(error){
            return console.log(error);
        }
        console.log('Message sent successfully, Host '+ st + ' UP. Info. : ' + info.response);
    });
}
async function siteStat()
{
        connection.query(getSites,function(error,results1,fields)
        {
            if(error) throw error;
            n = results1.length;
            
            for(i=0;i<n;i++) 
            {
                let site=results1[i].site;
                let portNo=results1[i].port;
                let id = results1[i].id;
                if(results1[i].status===0)
                {
                    
                    tcpPing.probe(site,portNo,function(err,available)
                    {
                        if(err) throw err;
                        if(!available)
                        {
                            console.log("flg 0 site Unavailable");
                            let dt1 = datetime.create();
                            dt1 = dt1.format('Y-m-d H:M:S');
                            var updQry = "update sites set status = " + true + " where site = '" + site + "' and id="+ id + " and port = "+ portNo;
                            connection.query(updQry,function(err,results2,fields)
                            {
                                if(err) throw err;
                                
                                
                            });
                            var insInStLog = "insert into sitelog (id,site,downtime,port) values ("+id +",'"+ site +"','"+ dt1 +"',"+portNo+")";
                            connection.query(insInStLog,function(error,results4,fields)
                            {
                                if (error) throw error;
                            });
                            var getMails = "select mail from mails where id="+ id;
                            connection.query(getMails,function(error,results5,fields)
                            {
                                if(error) throw error;
                                let o = results5.length;
                                for(var k=0;k<o;k++)
                                {
                                    let mail = results5[k].mail;
                                    sendDownMail(mail,dt1,site,portNo);
                                }
                            });
                            tcpPing.ping({address:site,attempts:3,port:portNo},function(err,data)
                            {
                                if(err)throw err;
                                let max = 0;
                                let min = 0;
                                let avg = 0;
                                
                                var uptSite = "update sites set maxMs="+max+", minMs="+min+", avgMs="+avg+" where id="+id+" and site='"+site+"' and port="+portNo;
                                connection.query(uptSite, function(error,results6,fields)
                                {
                                    if(error) throw error;
                                    
                                });

                                
                            });

                        }
                        if(available)
                        {
                            tcpPing.ping({address:site,attempts:3,port:portNo},function(err,data)
                            {
                                if(err)throw err;
                                let max,min,avg;
                                
                                max =data.max;
                                min = data.min;
                                avg =data.avg;
                                
                                if(max && min && avg)
                                {
                                    var uptSite ="update sites set maxMs="+max+", minMs="+min+", avgMs="+avg+" where id="+id+" and site='"+site+"' and port="+portNo;
                                    connection.query(uptSite, function(error,results7,fields)
                                    {
                                        if(error) throw error;
                                        
                                    });
                                }
                                
                                
                                

                            });
                        }
                    });
                }
                if(results1[i].status===1)
                {
                    tcpPing.probe(site,portNo,function(err,available)
                    {
                        if(available)
                        {
                            console.log("flg 1 site available");
                            if(err) throw err;
                            let dt2 = datetime.create();
                            let ttltimedown;
                            dt2 = dt2.format('Y-m-d H:M:S');
                            
                            var updQry = "update sites set status = " + false + " where site = '" + site + "' and id="+ id;
                            connection.query(updQry,function(err,results8,fields)
                            {
                                if(err) throw err;
                                
                                
                            });
                            
                            var getNoSiteLog = "select No,downtime from sitelog where id="+id+" and site='"+site+"' and downtime=(select max(downtime) from sitelog where id="+id+" and site ='"+site+"') ";
                            connection.query(getNoSiteLog,function(error,results9,fields)
                            {
                                if (error) throw error;
                                
                                    let no =  results9[0].No;
                                    let downtime =  results9[0].downtime;
                                    let times = getTimeRemaining(dt2,downtime);
                                    ttltimedown = times[0];
                                    var updSiteLog = "update sitelog set uptime='"+dt2+"', days="+times[1] +",hours = "+times[2]+", minutes = "+times[3]+" , seconds="+times[4]+"  where No="+no;
                                    connection.query(updSiteLog,function(error,results10,fields)
                                    {
                                        if (error) throw error;
                                        
                                    });
                                
                                
                                
                                
                            });
                            
                            var getMails = "select mail from mails where id="+ id;
                            connection.query(getMails,function(error,results11,fields)
                            {
                                if(error) throw error;
                                let o = results11.length;
                                for(var k=0;k<o;k++)
                                {
                                    let mail = results11[k].mail;
                                    sendUpMail(mail,dt2,ttltimedown,site,portNo);
                                }
                            });

                            
                            tcpPing.ping({address:site,attempts:3,port:portNo},function(err,data)
                            {
                                if(err)throw err;
                                let max = data.max;
                                let min = data.min;
                                let avg = data.avg;
                                
                                var uptSite = "update sites set maxMs="+max+", minMs="+min+", avgMs="+avg+" where id="+id+" and site='"+site+"' and port="+portNo;
                                connection.query(uptSite, function(error,results12,fields)
                                {
                                    if(error) throw error;
                                    
                                });

                                
                            });
                        }
                        
                    });
                    
                } 
                
            }
        });
    
}

try{
    siteStat();
    setInterval(siteStat,5000);
}
catch(error)
{
    console.log(error);
}


