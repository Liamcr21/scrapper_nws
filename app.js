import * as cheerio from 'cheerio';
import fetch from 'node-fetch';
import fs from 'fs';

async function getInfoacc(url) {
  try {
    const response = await fetch(url);
    const body = await response.text();
    
    const $ = cheerio.load(body);
    
    const produit = [];
    
    $('.d-grid').children().map((i, el) => {
      const titre =$(el).find('.card-title').text();
      const img = $(el).find('img').attr('src');
      const sale = $(el).find('.badge').text();
      const lien = 'http://vps-a47222b1.vps.ovh.net:8484' + $(el).find('a').attr('href')
      produit.push({
        titre,
        img,
        sale,
        lien
      });
      
    });
      
    fs.writeFile('pageacc.json', JSON.stringify(produit) + ',' , function(err){
        if (err) return console.log(err);
       console.log('in pageacc.json');
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


