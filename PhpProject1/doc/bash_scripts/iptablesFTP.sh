#!/bin/bash
#Consultarà les IP des de les que s'han de permetre connexions FTP i en crearà una regla IPTABLES

ESCANERS=`mysql -u consulta -D escaners -e "select ipaccess from rolftp;" -B -N`;

for i in $ESCANERS
        do
                iptables -A INPUT -p tcp -s $i -d 161.116.21.185 --dport 21 -j ACCEPT;
done
