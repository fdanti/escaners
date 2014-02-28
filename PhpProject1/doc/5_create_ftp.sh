Aquest document conté els passos necessaris per crear el bash script
     que generarà les carpetes FTP en el servidor.

L'usuari www-data executarà aquest script amb 2 paràmetres:
        repositori  serà el nom del repositori i es crearà la carpeta $ROOT/$repositori
        id          serà el UID de l'usuari FTP amb drets d'escriptura sobre la carpeta

###########

Creem el shel script /serveis/ftp/createFTP.sh amb el següent contingut:
    #######################################################
    #!/bin/bash                                                                                                                   
    #Aquest script s'ocuparà de crear les carpetes pels nous repositoris FTP.                                                     
    #S'executarà per part de l'usuari www-data (Apache) i necessitarà drets de sudo per fer els chown                             
    # Rebrà com a paràmetres el nom de repositori i un id d'usuari.                                                               
    # Retornarà 0 en cas de success i un valor >0 en cas d'error:                                                                 
            # 0 Success                                                                                                           
            # 1 La carpeta arrel $PATH no existeix                                                                                
            # 2 El nombre de parametres és incorrecte                                                                             
            # 3 La carpeta a crear ja existeix (controlat via PHP, però per si de cas)                                            
            # 4 el ID no és numèric major a 2000                                                                                  

    #### Variables ####                                                                                                           
    ROOT=/serveis/ftp/data;                  #Carpeta on es crearan els shares                                                    
    LOG_FILE=$ROOT/create_ftp.log;           #Hi desarem els logs del que fem

    #### Verificacions i control dels paràmetres ####
    #La carpeta $path ha d'existir
    if [ ! -d $ROOT ]; then
            exit 1;
    fi

    #Hem de rebre 2 parametres
    if (( $# != 2 )); then
            exit 2;
    fi

    # Lectura de paràmetres
    REPOSITORI=$1;
    ID=$2

    #La carpeta share no pot exisitir prèviament
    if [ -d $ROOT/$REPOSITORI ]; then
            exit 3;
    fi

    #ID ha de ser numeric > 2000
    if [[ $ID =~ '^[0-9]+$' ]] || (( $ID < 2000 )); then
            exit 4;
    fi

    echo `date` "Created folder=$ROOT/$REPOSITORI with owner=$ID" >> $LOG_FILE;
    mkdir $ROOT/$REPOSITORI;
    chmod 700 $ROOT/$REPOSITORI;
    chown $ID $ROOT/$REPOSITORI;
    #######################################################
Cal ajustar el valor de la variable $ROOT per tal que es generin les carpetes 
        dels FTP en /serveis/ftp/data/
Fem chmod per protegir-lo:
    chmod 701 /serveis/ftp/createFTP.sh

Fem que l'usuari www-data pugi executar el script amb drets de superadmin via sudoers.
    ·Instal·lem el paquet sudo
        aptitude install sudo
    ·Creem el fitxer /etc/sudoers.d/createFtp amb el contingut següent:
        www-data        ALL = NOPASSWD: /serveis/ftp/createFTP.sh
        





