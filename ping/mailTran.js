var mailTran = 
{
    mtPool:'true',
    mtHost:'smtp.gmail.com',
    mtPort: 465,
    mtSecure: true,
    mtService: 'gmail',
    mtUser: 'some@email.com',   //add an email
    mtPass: 'some_password',    //use the 3rd part password of the email above
    mtSubDn: 'Site DOWN.',
    mtSubUp: 'Site UP.',
    mtStatUp: 'UP',
    mtStatDwn: 'DOWN'
}

module.exports = mailTran;