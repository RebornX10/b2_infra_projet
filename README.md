# Project Infra SI

## Server Monitoring

### Samuel Adone & Marie Dugoua

---

- **Tabs  :**
  - Admin (monitoring)
  - User (manage server)

---

- **Features**:
  - Admin :
    - Add a new server
    - Connect to the server's _CLI_
    - Delete the server
    - View how many people in server
  - User : 
    - Manage server (change weather, date/hour, items)
  - Admin :
    - Manage access
    - Manage players
    - Manage connections
  - *Specs* 
    - RAM 2Gb
    - Dual core CPU 
    - Basically, this could run on a toaster
------

##### Installation

1. **Vagrant**

   First you need to install [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

   Then [Vagrant](https://www.vagrantup.com/), install the needed [packages](https://www.vagrantup.com/downloads) for your Operation System. 
   After installing Vagrant, make sur the installation worked by opening a console, and checking that `vagrant` is available. Like following :

   ```bash
   $ vagrant
   Usage: vagrant [options] <command> [<args>]
   
       -v, --version                    Print the version and exit.
       -h, --help                       Print this help.
   
   # ...
   ```

2. **Apache server**

   You'll need Apache Web Server:
	- [Wamp](https://www.wampserver.com/) for windows 
	- [Lamp](https://doc.ubuntu-fr.org/lamp) for Linux
	- [Mamp](https://www.mamp.info/fr/mamp/mac/) for MacOs.

3. **Source Code**

   You'll have to download the source code from here [RebornX10](https://github.com/RebornX10/b2_infra_projet) 
   or Clone it with::

   ```bash
   $ mkdir Console
   $ cd Console/

   $ git clone https://github.com/RebornX10/b2_infra_projet.git
   ```


##### Configuration

1. **Vagrant**

   Now, we will need to set up the "Vagrantfile" located in `vagrant_stuff`:

   ```bash
   # GNU/Linux
   $ ip a
   
   # look for "eth0" or "wlan0" and copy the IP address and the name of the adapter
   ```

   ```bash
   # MacOS
   $ ifconfig
   
   # look for "en0" and copy the IP address and the name of the adapter
   ```

   ```bash
   # Windows
   $ ipconfig
   
   # look for "Ethernet" and copy the IP address and the name of the adapter
   ```

   Open with vim, nano or whatever text editor you want, the vagrantfile.

   ```bash
   $ cd ./b2_infra_projet/vagrant_stuff/
   
   $ vim vagrantfile
   ```

   look for the following line and change "wlan0" and "192.168.0.99" to yours (what we copied earlier):

   ```bash
   config.vm.network "public_network", bridge: "wlan0", ip: "192.168.0.99"
   ```


##### How to launch the server and the websocket:

   Open a new terminal, go to the your cloned directory:

   ```bash
   $ cd vagrant_stuff/

   $ vagrant up
   [...]
   $ vagrant ssh
   [...]
   [vagrant@node0 ~]$ ./start
   ```

   Congratulations now you have a working minecraft server ready to be managed through the Web Interface.
