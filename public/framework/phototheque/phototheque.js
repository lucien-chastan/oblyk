//DÉFINITION DE LA CLASSE PHOTOTHEQUE
class Phototheque {

    constructor(element, option){
        this.groupImg = document.querySelector(element);
        this.photothequeWidth = this.groupImg.offsetWidth;
        this.allImg = this.groupImg.querySelectorAll('img');
        this.nbImg = this.allImg.length;
        this.ratioTable = [];
        this.gridRatio = this.photothequeWidth / parseInt(this.maxHeight);
        this.sommeRatio = 0;
        this.nbLoadPhoto = 0;

        //construit et affiche le laoder de la phototheque
        this.svgLoadPhototheque = document.createElement('div');
        this.svgLoadPhototheque.className = 'phototheque-div-loader';
        this.svgLoadPhototheque.innerHTML =
            `<svg viewBox="0 0 105 105" height="35px" width="35px">
                <rect class="phototheque-rect-load" id="phototheque-rect-load-1" y="0" x="0" height="49" width="39" style="fill:#000000;fill-opacity:0.8;stroke:none" />
                <rect class="phototheque-rect-load" id="phototheque-rect-load-2" y="0" x="46.52" height="49.12" width="59.09" style="fill:#000000;fill-opacity:0.8;stroke:none"/>
                <rect class="phototheque-rect-load" id="phototheque-rect-load-3" y="56.43" x="0" height="49.18" width="59.09" style="fill:#000000;fill-opacity:0.8;stroke:none" />
                <rect class="phototheque-rect-load" id="phototheque-rect-load-4" y="56.43" x="66.34" height="49.18" width="39.3" style="fill:#000000;fill-opacity:0.8;stroke:none"/>
            </svg>`;
        this.groupImg.appendChild(this.svgLoadPhototheque);

        //On charge les images de la phototheque
        this.loadPhototheque(element, option);

        //on place un écouteur sur sur le resize de l'élément window
        window.addEventListener('resize', ()=>{this.defineLigne()});
    }


    //CONFIGURE OU RECONFIGURE LES OPTIONS DE LA PHOTOTHEQUE
    setOption(element, option){
        //si nous n'avons pas d'option;
        option = (option)? option : [];

        //application des valeurs d'options ou par defaut
        this.maxHeight = (option['maxHeight'])? option['maxHeight'] : (this.maxHeight)? this.maxHeight : '350px';
        this.gouttiere = (option['gouttiere'])? option['gouttiere'].replace('px', '') : (this.gouttiere)? this.gouttiere : 0;
        this.lastRow = (option['lastRow'])? option['lastRow'] : (this.lastRow)? this.lastRow : 'left';
        this.visiotheque = (option['visiotheque'])? option['visiotheque'] : (this.visiotheque)? this.visiotheque : true;

        //On met en place la visionneuse si l'option est active
        if(this.visiotheque) this.visionneuse = new Visiotheque(element, option['visiotheque-option']);

        //on lance la définition des lignes et la retaille des images
        this.initStyle();
        this.initImgHeight(this.maxHeight);
        this.getRatios();
        this.defineLigne();
    }


    //DONNE DU STYLE AUX ÉLÉMENTS SUIVANT LES OPTIONS
    initStyle(){

        //goutière entre les éléments
        this.groupImg.style.letterSpacing = this.gouttiere - 5 + 'px';

        //alignement de la dernière ligne de la galrie
        this.groupImg.style.textAlign = this.lastRow;

        //style sur les images
        for(var i = 0 ; i < this.nbImg ; i++){
            this.allImg[i].style.display = 'inline-block';
            this.allImg[i].style.marginBottom = this.gouttiere + 'px';
        }

        this.animationLoadPhototheque();
    }

    //CHARGE LES PHOTOS ET LES AFFICHES À LA FIN
    loadPhototheque(element, option){

        for(var i = 0 ; i < this.allImg.length ; i ++){
            var loadImg = new Image();
            loadImg.src = this.allImg[i].src;
            loadImg.onload = ()=> {
                this.nbLoadPhoto++;
                if(this.nbLoadPhoto == this.allImg.length) this.setOption(element, option);
            }
        }
    }

    //ANIMATION DE L'APPARITION DES PHOTOS À LA FIN DU CHARGEMENT DES PHOTOS
    animationLoadPhototheque(){

        //on supprime le loader de la phototheque
        this.groupImg.removeChild(this.svgLoadPhototheque);

        //on affiche les photos avec une animation
        for(var i = 0 ; i < this.allImg.length ; i++){
            ((i)=>{setTimeout(()=>{this.allImg[i].style.opacity = '1';},(Math.random() * 300));})(i);
        }
    }

    //FONCTION POUR TAILLER LES PHOTOS EN HAUTEUR
    initImgHeight(imgHeight){
        for(var i = 0 ; i < this.nbImg ; i++){
            this.allImg[i].style.height = imgHeight;
        }
    }

    //TROUVE LES RATIOS DES IMAGES
    getRatios(){
        for(var i = 0 ; i < this.nbImg ; i++){
            let ratio = this.allImg[i].naturalWidth / this.allImg[i].naturalHeight;
            this.ratioTable[i] = ratio;
            this.sommeRatio += ratio;
        }
    }


    //FONCTION DE REDIMENSSIONNEMENT DES IMAGES
    defineLigne(){
        var ligneConstruct = [],
            photoATraiter = this.allImg,
            sommeLigne = 0;

        this.photothequeWidth = this.groupImg.offsetWidth;
        this.gridRatio = this.photothequeWidth / parseInt(this.maxHeight);

        for(var i = 0 ; i < this.nbImg ; i++){
            if((this.ratioTable[i] + sommeLigne) <= this.gridRatio){
                ligneConstruct.push(i);
                sommeLigne += this.ratioTable[i];
            }else{
                if((this.gridRatio - sommeLigne) > (this.ratioTable[i] / 2) ){

                    ligneConstruct.push(i);
                    sommeLigne += this.ratioTable[i];

                    this.resizeLigne(ligneConstruct, false);

                    //raz des données
                    sommeLigne = 0;
                    ligneConstruct = [];

                }else{

                    this.resizeLigne(ligneConstruct, false);

                    //raz des données
                    sommeLigne = 0;
                    ligneConstruct = [];

                    ligneConstruct.push(i);
                    sommeLigne += this.ratioTable[i];

                }
            }

            //si c'est la dernière ligne
            if(i == (this.nbImg - 1)){
                this.resizeLigne(ligneConstruct, true);
            }
        }
    }


    //LA FONCTION IMPORTANTE, C'EST ELLE QUI DÉCIDE DU CROP DES IMAGES
    resizeLigne(listePhoto, lastRow){
        var sommeLigneRatio = 0,
            deltaRatio,
            ratioToPixel,
            gouttiere,
            maxRatio = 0;

        for(var i = 0 ; i < listePhoto.length ; i++){
            sommeLigneRatio += this.ratioTable[listePhoto[i]];
        }

        deltaRatio = this.gridRatio - sommeLigneRatio;
        ratioToPixel = deltaRatio * this.photothequeWidth / this.gridRatio;

        //calcul de l'éclatement maximal de la dernière ligne de la gallerie
        if(lastRow){
            for(var j = 0 ; j < listePhoto.length ; j++){
                maxRatio += this.ratioTable[listePhoto[j]] * 2;
            }
        }

        for(var i = 0 ; i < listePhoto.length ; i++){
            gouttiere = (listePhoto.length - 1) * this.gouttiere / listePhoto.length;

            //redimenssionement des images
            if(!lastRow || maxRatio >= this.gridRatio)
                this.allImg[listePhoto[i]].style.width = this.rInf((parseInt(this.maxHeight) * this.ratioTable[listePhoto[i]]) + ratioToPixel / listePhoto.length - gouttiere) + 'px';
            else this.allImg[listePhoto[i]].style.width = 'auto';

            //on applique des styles
            if(lastRow) this.allImg[listePhoto[i]].style.marginBottom = '0px';
            else this.allImg[listePhoto[i]].style.marginBottom = this.gouttiere + 'px';
        }
    }

    rInf($n){
        return Math.ceil($n) - 1;
    }
}





//CLASS DE LA VISONNEUSE DE PHOTO
class Visiotheque{

    constructor(element, option){
        this.element = document.querySelector(element);
        this.imgCollection = this.element.querySelectorAll('img');

        //défini les options
        this.setOption(option);

        //création du fond noir
        this.creatElementStructure();

        //attribution des events click sur les image
        this.addEvents();

        //propriété si le diaporama est lancé
        this.runDiaporama = false;

        window.addEventListener('keypress',  (e)=>{this.visiothequeKeyPresse(e)});
    }

    //DÉFINI LES OPTIONS DE LA VISIONNEUSE
    setOption(option){

        this.typeLegende = (option['legende'])? option['legende'] : (this.typeLegende)? this.typeLegende : 'data-legende';
        this.diaporama = (option['diaporama'])? option['diaporama'] : (this.diaporama)? this.diaporama : false;
        this.diaporamaTimer = (option['diaporama-timer'])? (option['diaporama-timer'] * 1000) : (this.diaporamaTimer)? this.diaporamaTimer : (3 * 1000);

    }

    //CRÉER LA STRUCTURE DE LA VISIOTHEQUE
    creatElementStructure(){

        //création du fond et mise en place des attributs
        this.background = document.createElement('div');
        this.background.className = 'visiotheque-background';
        this.background.addEventListener('click', ()=>{this.closeVisiotheque()});
        this.background.addEventListener('mousemove', (event)=>{this.hideControl(event);});
        this.element.appendChild(this.background);

        //création du loader
        this.loader = document.createElement('div');
        this.loader.className = 'visiotheque-loader';
        this.background.appendChild(this.loader);

        //création de l'élément de zoomeuse
        this.imgOpenAnimation = document.createElement('img');
        this.imgOpenAnimation.className = 'visiotheque-img-open-animation';
        this.imgOpenAnimation.setAttribute('alt','');
        this.imgOpenAnimation.addEventListener('click', (event)=>{event.stopPropagation()});
        this.background.appendChild(this.imgOpenAnimation);

        //création de la boite à légende
        this.visothequeLegende = document.createElement('div');
        this.visothequeLegende.className = 'visiotheque-legende';
        this.background.appendChild(this.visothequeLegende);

        //création de la croix fermante
        this.visiothequeCloseControl = document.createElement('div');
        this.visiothequeCloseControl.className = 'visiotheque-close-control visiotheque-control';
        this.visiothequeCloseControl.title = 'Fermer (échape)';
        this.visiothequeCloseControl.innerHTML =
            `<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg viewBox="0 0 40 40" height="11.288889mm" width="11.288889mm">
                <g transform="matrix(1.115436,0,0,1.115436,-38.309857,-66.237104)">
                    <circle style="fill:#000000;fill-opacity:0.78431373;fill-rule:evenodd;stroke:none;" cx="52.275394" cy="77.312462" r="17.930208" />
                    <g transform="matrix(1.338671,0,0,1.338671,-18.718359,-25.169291)" style="stroke-width:1.49401903;stroke-miterlimit:4;stroke-dasharray:none">
                        <path d="M 47.586581,71.108416 58.479437,82.001272" style="fill:none;stroke:#ffffff;stroke-width:1.49401903;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                        <path style="fill:none;;stroke:#ffffff;stroke-width:1.49401903;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="M 58.479437,71.108416 47.586581,82.001272"/>
                    </g>
                </g>
            </svg>`;
        this.visiothequeCloseControl.addEventListener('click', this.closeVisiotheque);
        this.background.appendChild(this.visiothequeCloseControl);

        //création de la flèche gauche
        this.visiothequeLeftControl = document.createElement('div');
        this.visiothequeLeftControl.className = 'visiotheque-left-control visiotheque-control';
        this.visiothequeLeftControl.title = 'Photo suivante (flèche droite)';
        this.visiothequeLeftControl.innerHTML =
            `<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg viewBox="0 0 35.860416 35.860416" height="10.120606mm" width="10.120606mm">
                <g transform="translate(-34.345186,-106.41619)">
                    <circle r="17.930208" cy="124.3464" cx="52.275394" style="fill:#000000;fill-opacity:0.78431373;fill-rule:evenodd;stroke:none;"/>
                    <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 62.58639,124.3464 -20.621992,0" id="path7052" />
                    <path d="m 49.442076,131.82408 -7.477678,-7.47768 7.477678,-7.47767" style="fill:none;stroke:#ffffff;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                </g>
            </svg>
            `;
        this.visiothequeLeftControl.addEventListener('click', (event)=>{this.visiothequeSlider('left');event.stopPropagation()});
        this.background.appendChild(this.visiothequeLeftControl);

        //création de la flèche droite
        this.visiothequeRightControl = document.createElement('div');
        this.visiothequeRightControl.className = 'visiotheque-right-control visiotheque-control';
        this.visiothequeRightControl.title = 'Photo précédente (flèche gauche)';
        this.visiothequeRightControl.innerHTML =
            `<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg viewBox="0 0 35.860416 35.860416" height="10.120606mm" width="10.120606mm">
                <g transform="translate(-34.345186,-155.05203)">
                    <circle style="fill:#000000;fill-opacity:0.78431373;fill-rule:evenodd;stroke:none;" cx="-52.275394" cy="172.98224" r="17.930208" transform="scale(-1,1)" />
                    <path d="m 41.964399,172.98222 20.621992,0" style="fill:none;stroke:#ffffff;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                    <path style="fill:none;stroke:#ffffff;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 55.108713,180.4599 7.477678,-7.47768 -7.477678,-7.47767"/>
                </g>
            </svg>`;
        this.visiothequeRightControl.addEventListener('click', (event)=>{this.visiothequeSlider('right');event.stopPropagation()});
        this.background.appendChild(this.visiothequeRightControl);

        if(this.diaporama){

            //bouton play du diaporama
            this.visiothequePlayControl = document.createElement('div');
            this.visiothequePlayControl.className = 'visiotheque-play-control visiotheque-control';
            this.visiothequePlayControl.title = 'Lancer le diaporama (barre espace)';
            this.visiothequePlayControl.innerHTML =
                `<?xml version="1.0" encoding="UTF-8" standalone="no"?>
                <svg viewBox="0 0 40 40" height="11.288889mm" width="11.288889mm">
                    <g transform="translate(-34.345186,-201.05203)">
                        <circle transform="scale(-1,1)" r="17.930208" cy="218.98224" cx="-52.275394" style="fill:#000000;fill-opacity:0.78431373;fill-rule:evenodd;stroke:none;" />
                        <path style="fill:#ffffff;fill-rule:evenodd;stroke:none;" d="m 63.070332,218.98224 -8.132748,4.69544 -8.132746,4.69545 1e-6,-9.39089 -1e-6,-9.39089 8.132747,4.69545 z" />
                    </g>
                </svg>`;
            this.visiothequePlayControl.addEventListener('click', (event)=>{this.playVisiotheque(); event.stopPropagation()});
            this.background.appendChild(this.visiothequePlayControl);

            //bouton pause du diaporama
            this.visiothequePauseControl = document.createElement('div');
            this.visiothequePauseControl.className = 'visiotheque-pause-control visiotheque-control';
            this.visiothequePauseControl.title = 'Mettre en pause le diaporama (barre espace)';
            this.visiothequePauseControl.innerHTML =
                `<?xml version="1.0" encoding="UTF-8" standalone="no"?>
                <svg viewBox="0 0 35.860416 35.860416" height="10.120606mm" width="10.120606mm">
                    <g transform="translate(-34.345186,-249.05203)">
                        <circle style="fill:#000000;fill-opacity:0.78431373;fill-rule:evenodd;stroke:none;" cx="-52.275394" cy="266.98224" r="17.930208" transform="scale(-1,1)" />
                        <g transform="matrix(0.89473685,0,0,0.89473685,8.157645,28.172071)">
                            <rect y="258.00351" x="40.911179" height="17.803938" width="6.4397225" style="fill:#ffffff;fill-rule:evenodd;stroke:none;" />
                            <rect style="fill:#ffffff;fill-rule:evenodd;stroke:none;" width="6.4397225" height="17.803938" x="51.265244" y="258.00351" />
                        </g>
                    </g>
                </svg>`;
            this.visiothequePauseControl.style.display = 'none';
            this.visiothequePauseControl.addEventListener('click', (event)=>{this.pauseVisiotheque(); event.stopPropagation()});
            this.background.appendChild(this.visiothequePauseControl);
        }

    }


    //AJOUTE LES ÉVENEMENTS AUX CLICS SUR LES IMAGES DE LA PHOTOTEQUE
    addEvents(){
        for(var i = 0 ; i < this.imgCollection.length ; i++){
            this.imgCollection[i].setAttribute('data-n-child', i);
            this.imgCollection[i].addEventListener('click', (i)=>{this.openVisiotheque(i);});
        }
    }

    //LANCE L'OUVERTURE DE LA VISOTHEQUE
    openVisiotheque(img){
        this.imgClick = img;
        this.background.style.display = 'block';
        this.currentPhoto = img.target.getAttribute('data-n-child');

        //temps d'attente avant de faire la fondu au noir
        var sleepToOpen = setTimeout(()=>{

            //affichage du background et les controles
            this.background.style.backgroundColor = 'rgba(0,0,0,0.8)';
            this.visiothequeCloseControl.style.opacity = 1;
            this.visiothequeLeftControl.style.opacity = 1;
            this.visiothequeRightControl.style.opacity = 1;
            if(this.diaporama) this.visiothequePlayControl.style.opacity = 1;

            //affichage d'un loader
            this.showLoader(true);

            //on charge la nouvelle source de l'image
            if(img.target.getAttribute('data-full')){
                var newImage = new Image();
                newImage.src = this.imgClick.target.getAttribute('data-full');
                newImage.onload = ()=>{
                    this.imgOpenAnimation.src = newImage.src;
                    this.grandePhoto = this.imgOpenAnimation;
                    setTimeout(()=>{
                        this.openAnimation();
                    },50);
                }
            }else{
                this.imgOpenAnimation.src = this.imgClick.target.src;
                this.grandePhoto = this.imgOpenAnimation;
                setTimeout(()=>{
                    this.openAnimation();
                },50);
            }
        },20);
    }

    //ANIME L'OUVERTURE DE VISIONNEUSE
    openAnimation(){
        var scrollPosition = this.getScrollPosition(),
            positionImg = {
                'top' : this.imgClick.target.offsetTop - scrollPosition[1],
                'left' : this.imgClick.target.offsetLeft - scrollPosition[0]
            };

        //on cache le loader
        this.showLoader(false);

        //attribut de l'imgAnimationOpen
        this.imgOpenAnimation.style.display = 'inline-block';
        this.imgOpenAnimation.style.opacity = 1;

        var sleepToZoom = setTimeout(()=>{
            this.imgOpenAnimation.style.transition = 'top 0.3s, left 0.3s, max-height 0.3s, max-width 0.3s, opacity 0.5s, transform 0.5s';
            this.positionneCurrentPhoto();
            this.imgOpenAnimation.style.transform = 'scale(1)';
        },50);
    }


    //DONNE LE LEFT ET LE RIGHT À L'IMAGE ET À LA LÉGENDE
    positionneCurrentPhoto(){
        var currentPhoto = this.imgCollection[this.currentPhoto],
            altLegende = currentPhoto.getAttribute('alt'),
            dataLegende = currentPhoto.getAttribute('data-legende');


        //on charge en cache les photos suivantes et précédente
        this.photosInCache();

        //donne la valeur à la légende
        if(this.typeLegende != '') this.visothequeLegende.innerHTML = (this.typeLegende == 'alt')? altLegende : dataLegende;

        //variable de calcul
        var photoDimension = {"height" : this.grandePhoto.naturalHeight, "width" : this.grandePhoto.naturalWidth},
            zoneDimension = {
                "height" : (this.background.offsetHeight - this.visothequeLegende.offsetHeight - 34),
                "width" : (this.background.offsetWidth - 10)
            },
            deltaVertical = photoDimension['height'] - zoneDimension['height'],
            deltaHorizontal = photoDimension['width'] - zoneDimension['width'],
            maxDelta = (Math.abs(deltaVertical) > Math.abs(deltaHorizontal))? deltaVertical : deltaHorizontal;

        //calcul des décalages en left et right
        if(deltaVertical > 0 || deltaHorizontal > 0){
            //si notre photo à au moins une dimension suprérieur au cadre
            var decalageLeft = 5,
                decalageTop = 5;

            //photo typé portrait
            if(Math.abs(deltaVertical) > Math.abs(deltaHorizontal)) decalageLeft = (zoneDimension['width'] - (photoDimension['width'] * zoneDimension['height'] / photoDimension['height'])) / 2;

            //photo typé paysage
            if(Math.abs(deltaVertical) < Math.abs(deltaHorizontal)) decalageTop = (zoneDimension['height'] - (photoDimension['height'] * zoneDimension['width'] / photoDimension['width'])) / 2;

            //on attribut les valeurs
            this.imgOpenAnimation.style.marginTop = decalageTop + 'px';
        }else{
            //si notre image naturel est plus petite que la zone d'affichage
            this.imgOpenAnimation.style.marginTop = (zoneDimension['height'] - photoDimension['height']) / 2 + 'px';
        }

        //hauteur et largeur de l'image
        this.imgOpenAnimation.style.maxHeight = 'calc(100% - ' + (this.visothequeLegende.offsetHeight + 34) + 'px)';
        this.imgOpenAnimation.style.maxWidth = 'calc(100% - 10px)';

    }

    //CHARGE L'IMAGE SUIVANTE ET L'IMAGE PRÉCÉDENTE DE L'IMAGE COURANTE
    photosInCache(){
        //photo précédente
        if(this.currentPhoto > 0){
            this.photoPrecedente = new Image();
            if(this.imgCollection[this.currentPhoto - 1].getAttribute('data-full')) this.photoPrecedente.src = this.imgCollection[this.currentPhoto - 1].getAttribute('data-full');
            else this.photoPrecedente.src = this.imgCollection[this.currentPhoto - 1].src;
        }
        //photo suivante
        if(this.currentPhoto < this.imgCollection.length - 1){
            this.photoSuivante = new Image();
            if(this.imgCollection[parseInt(this.currentPhoto) + 1].getAttribute('data-full')) this.photoSuivante.src = this.imgCollection[parseInt(this.currentPhoto) + 1].getAttribute('data-full');
            else this.photoSuivante.src = this.imgCollection[parseInt(this.currentPhoto) + 1].src;
        }
    }

    //CACHE OU AFFICHE LES CONTRÔLES DROITE ET GAUCHE
    hideControl(event){

        if(event.clientX < 100 || event.clientX > (this.background.offsetWidth - 100)){
            this.visiothequeLeftControl.style.transform = 'translateX(0px)';
            this.visiothequeRightControl.style.transform = 'translateX(0px)';
        }else{
            this.visiothequeLeftControl.style.transform = 'translateX(-50px)';
            this.visiothequeRightControl.style.transform = 'translateX(50px)';
        }
    }

    //FONCTION DE SLIDE AU KEYPRESS
    visiothequeKeyPresse(e){
        if(e.keyCode == 39) this.visiothequeSlider('right');
        if(e.keyCode == 37) this.visiothequeSlider('left');
        if(e.charCode == 32){
            if(this.runDiaporama) this.pauseVisiotheque();
            else this.playVisiotheque();
        }
    }

    //FONCTION POUR AFFICHER LE LOADER
    showLoader(yn){
        this.loader.style.backgroundColor = (yn)? 'rgba(255,255,255,1)' : 'rgba(255,255,255,0)';
    }

    //FONCTION SLIDE DROITE GAUCHE DE LA VISOTHEQUE
    visiothequeSlider(direction){
        var decLeft = (direction == 'left')? 150 : -150;

        //si nous ne somme pas sur les bords
        if((this.currentPhoto > 0 || direction == 'right') && (this.currentPhoto < (this.imgCollection.length - 1) || direction == 'left')){

            //on définie la prochaine photo à afficher
            this.currentPhoto = (direction == 'left')? (this.currentPhoto - 1) : (parseInt(this.currentPhoto) + 1);

            //animaton étape 1 : la photo par en transparence
            this.imgOpenAnimation.style.transition = 'opacity 0.3s, left 0.3s, transform 0.5s';
            this.imgOpenAnimation.style.left = this.imgOpenAnimation.offsetLeft + decLeft + 'px';
            this.imgOpenAnimation.style.opacity = 0;

            var sleepAnimation = setTimeout(()=>{

                //on charge la nouvelle photo dans imgOpenAnimation
                this.imgOpenAnimation.src = (direction == 'right')? this.photoSuivante.src : this.photoPrecedente.src;

                //on affiche le loader
                this.showLoader(true);

                //on charge la source de l'image
                this.imgOpenAnimation.onload = ()=>{

                    //on cache le loader
                    this.showLoader(false);

                    //on coupe les transitions
                    this.imgOpenAnimation.style.transition = 'all 0s';

                    //on positionne la nouvelle photo
                    this.positionneCurrentPhoto();

                    //animation étape 2 : on ramène la photo à deux fois sa valeur de left
                    setTimeout(()=>{
                        var initialDecalage = this.imgOpenAnimation.offsetLeft;
                        this.imgOpenAnimation.style.left = this.imgOpenAnimation.offsetLeft - decLeft + 'px';

                        //animation étape 3 : on affiche la nouvelle photo
                        setTimeout(()=>{
                            this.imgOpenAnimation.style.transition = 'opacity 0.3s, left 0.3s, max-height 0.3s, max-width 0.3s, opacity 0.5s, top 0.3s';
                            this.imgOpenAnimation.style.opacity = 1;
                            this.imgOpenAnimation.style.left = initialDecalage + 'px';
                        },30);
                    }, 30);
                }
            }, 300);
        }else{
            //on montre qu'on est en buté
            var initialDecalage = this.imgOpenAnimation.offsetLeft;
            this.imgOpenAnimation.style.left = initialDecalage + decLeft / 2 + 'px';
            setTimeout(()=>{this.imgOpenAnimation.style.left = initialDecalage + 'px'},300);
        }
    }


    //FUNCTION QUI FAIT DÉFILER LES PHOTOS AUTOMATIQUEMENT
    playVisiotheque(){

        //on note que le diaporama tourne
        this.runDiaporama = true;

        //on change le style des boutons pause et play
        this.visiothequePauseControl.style.display = 'block';
        this.visiothequePauseControl.style.opacity = 1;
        this.visiothequePlayControl.style.display = 'none';
        this.visiothequePlayControl.style.opacity = 0;

        //on lance le set time interval
        setTimeout(()=>{
            this.intervalDiaporama = setInterval(()=>{
                if(this.currentPhoto < this.imgCollection.length - 1){
                    this.visiothequeSlider('right');
                }else{
                    this.pauseVisiotheque();
                }
            }, this.diaporamaTimer);
        }, this.diaporamaTimer);
    }


    //FUNCTION QUI STOP LE DÉFILEMENT DES PHOTOS
    pauseVisiotheque(){

        //on note que le diaporama ne tourne plus
        this.runDiaporama = false;

        //on change le style des boutons
        this.visiothequePauseControl.style.display = 'none';
        this.visiothequePauseControl.style.opacity = 0;
        this.visiothequePlayControl.style.display = 'block';
        this.visiothequePlayControl.style.opacity = 1;


        //on arrête le timinterval
        clearInterval(this.intervalDiaporama);
    }

    //FERMETURE DE LA VISIONNEUSE
    closeVisiotheque(){
        var scrollPosition = this.getScrollPosition();

        //disparition du fond et des contrôles
        this.background.style.backgroundColor = 'rgba(0,0,0,0)';
        this.visiothequeCloseControl.style.opacity = 0;
        this.visiothequeLeftControl.style.opacity = 0;
        this.visiothequeRightControl.style.opacity = 0;
        if(this.diaporama) this.visiothequePlayControl.style.opacity = 0;

        //animation de fermeture de la photo
        this.imgOpenAnimation.style.transform = 'scale(0.5)';
        this.imgOpenAnimation.style.opacity = 0;
        var sleepToclose = setTimeout(()=>{
            this.background.style.display = 'none';
            this.imgOpenAnimation.style.top = null;
            this.imgOpenAnimation.style.left = null;
            this.imgOpenAnimation.style.transition = null;
        }, 500);
    }


    //RETOURNE LE DÉCALAGE DU SCROLL
    getScrollPosition(){
        return Array((document.documentElement && document.documentElement.scrollLeft) || window.pageXOffset || self.pageXOffset || document.body.scrollLeft,(document.documentElement && document.documentElement.scrollTop) || window.pageYOffset || self.pageYOffset || document.body.scrollTop);
    }
}
