// import * as cheerio from 'cheerio';
// import fetch from 'node-fetch';
// import fs from 'fs';

// // debut de json ajouter un [ 
// fs.writeFile('pageproduit.json', '[' , function(err){
//     if (err) return console.log(err);
//   });


// // début fonction
// async function getInfoacc(url) {
//     try {
//       const response = await fetch(url); // url = boucle
//       const body = await response.text();
      
//       const $ = cheerio.load(body);
       
     
//       //const produitcomplet = [];
  
//       // info de recup html
//       $('.pb-3').children().map((i, el) => {
//         const produitcomplet = {
//             url: url,
//            titreproduit : $(el).find('.display-4').text(),
//           description : $(el).find('.p-1').find('p').text(),
//           prix : $(el).find('.p-1').find('h3').text(),
//         };
        
//         // ecriture des éléments html qu'on a recup dans json
//         fs.appendFileSync('pageproduit.json', JSON.stringify(produitcomplet) + ',' , function(err){
//           if (err) return console.log(err);
//         //  console.log('in pageacc.json');
//         });
       
        
//         // produitcomplet.push({
          
//         //   titre,
//         //   img,
//         //   sale,
//         //   lien,
//         // });
//       });
        
      
    
     
      
//     } catch (error) {
//       console.log(error);
//     }
//   }


// // boucle de l'url pour 8 pages

// let url = 'http://vps-a47222b1.vps.ovh.net:8484/Product/';
//  let i = 0;
//  let numpage = 1;
// while(i<120){
//    url = 'http://vps-a47222b1.vps.ovh.net:8484/Product/' + numpage;
//    getInfoacc(url);
//   i++;
//   numpage++;
//   //console.log(url);
// }


// // ajout de l'acolade de fin

// setTimeout(function () {
//     fs.readFile('pageproduit.json', 'utf8', (err, data) => {
//       if (err) throw err;
    
//       // replace the last character with a new string
//       const newData = data.slice(0, -1) + ']';
    
//       // write the updated data to the file
//       fs.writeFile('pageproduit.json', newData, 'utf8', (err) => {
//         if (err) throw err;
//       });
//     });
//   },1000)