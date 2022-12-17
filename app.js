import * as cheerio from 'cheerio';
import fetch from 'node-fetch';
import fs from 'fs';


fs.writeFile('pageacc.json', '[' , function(err){
    if (err) return console.log(err);
  });

async function getInfoacc(url) {
    try {
      const response = await fetch(url);
      const body = await response.text();
      
      const $ = cheerio.load(body);
       
     
      //const produit = [];
  
      $('.d-grid').children().map((i, el) => {
        const produit = {
           titre : $(el).find('.card-title').text(),
           img : $(el).find('img').attr('src'),
           sale : $(el).find('.badge').text(),
          lien : 'http://vps-a47222b1.vps.ovh.net:8484' + $(el).find('a').attr('href')
        };
        
        fs.appendFileSync('pageacc.json', JSON.stringify(produit) + ',' , function(err){
          if (err) return console.log(err);
        //  console.log('in pageacc.json');
        });
       
        
        // produit.push({
          
        //   titre,
        //   img,
        //   sale,
        //   lien,
        // });
      });
        
      
    
     
      
    } catch (error) {
      console.log(error);
    }
  }




let url = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/';
 let i = 0;
 let numpage = 1;
while(i<8){
   url = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + numpage;
   getInfoacc(url);
  i++;
  numpage++;
  //console.log(url);
}


setTimeout(function () {
    fs.readFile('pageacc.json', 'utf8', (err, data) => {
      if (err) throw err;
    
      // replace the last character with a new string
      const newData = data.slice(0, -1) + ']';
    
      // write the updated data to the file
      fs.writeFile('pageacc.json', newData, 'utf8', (err) => {
        if (err) throw err;
      });
    });
  },1000)