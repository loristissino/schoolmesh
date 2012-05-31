#!/bin/bash

# This script may be used to enable port forwarding under NAT configuration with VirtualBox machines
# After running this script, you can access the guest web server from the host machine pointing your browser at
# http://127.0.0.1:11080 or at https://127.0.0.1:11080, and make ssh connections with ssh -p 11022 127.0.0.1.

MACHINE=$1

if [[ "$MACHINE" = "" ]]; then
  echo "Usage: $0 machinename"
  exit 1
fi

vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwww/Protocol' TCP
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwww/HostPort' 11080
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwww/GuestPort' 80

vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwwws/Protocol' TCP
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwwws/HostPort' 11443
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestwwws/GuestPort' 443

vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestssh/Protocol' TCP
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestssh/HostPort' 11022
vboxmanage setextradata $MACHINE 'VBoxInternal/Devices/pcnet/0/LUN#0/Config/guestssh/GuestPort' 22

