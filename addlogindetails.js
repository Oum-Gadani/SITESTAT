const express = require('express');
const app = express();
const con = require('./connection')

const bodyParser = require('body-parser');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));

app.get('/',function(req,res){
    res.sendFile(__dirname+'/signup.html');

});

app.post('/',function(req,res){
    var uname = req.body.uname;
    var email = req.body.email;
    var password = req.body.password;

    con.connect(function(error){
        if(error) throw error;
        
        var insQry = "insert into users (username,email,password) values (?, ? , ?)";
        con.query(insQry,[uname,email,password],function(error,result){
            if(error) throw error;
            res.send('SignIn Successful....');
        });
    });
});

app.listen(7000);