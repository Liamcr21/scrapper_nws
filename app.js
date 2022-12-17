import * as cheerio from 'cheerio';
import fetch from 'node-fetch';
import fs from 'fs';

async function getInfoacc() {
  try {
    const response = await fetch('http://vps-a47222b1.vps.ovh.net:8484/Product/page/1');
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
      
    console.log(produit);
    
  } catch (error) {
    console.log(error);
  }
}

getInfoacc();