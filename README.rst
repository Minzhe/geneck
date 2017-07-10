GeNeck
======

.. contents:: GeNeck: a online tool kit for gene network construction.
   :local:

Requirement
-----------
* PHP
    - **PHP** (developed with PHP 7.0.18)
* MySQL
    - **MySQL** (developed with MySQL 5.7.18)
* Python & modules:
    - **Python 3** (developed in Python 3.6.1 | Anaconda 4.4.0)
    - **PyMySQL** (developed with PyMySQL 0.7.11)
* R & libraries
    - **R** (developed with R 3.2.3)
    - **argparse** (developed with argparse 1.0.4)
    - **corpcor** (developed with corpcor 1.6.9)
    - **GeneNet** (developed with GeneNet 1.2.13)
    - **CDLasso** (developed with CDLasso 1.1)
    - **glasso** (developed with glasso 1.8)
    - **space** (developed with space 0.1.1)
    - **espace** (install the package with the tar.gz included in bin/lib/ folder)

Deployment
----------
* MySQL databasse
    - Edit the ``geneck.inc`` in ``bin/deploy/`` folder, and move it to ``dbincloc/`` folder which should be two level up of ``geneck/`` folder (``../../dbincloc``).
    - Import the ``geneNetwork.sql.txt`` to mysql database.
* Crontab
    - The ``job.py`` script needs to be added into crontab or run periodically.
    - When run ``job.py``, be sure to first change the working directory to the ``bin/`` foder. This is essential, because the python script relies on the relative path structure.
    - Make sure all python module can be import successfully in crontab (especially when you are using anaconda). Crontab job can have different environment setting compared to direct running command in terminal.
    - Example:
        * ``* * * * * export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``
        * ``* * * * * sleep 10; export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``
        * ``* * * * * sleep 20; export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``
        * ``* * * * * sleep 30; export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``
        * ``* * * * * sleep 40; export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``
        * ``* * * * * sleep 50; export PATH="/opt/anaconda3/bin:$PATH"; cd /home/minzhe/public_html/geneck/bin; python job.py``

* PHP
    - Make sure the ``post_max_size`` and ``upload_max_filesize`` in your ``php.ini`` file be set larger than 12M.

PHP page
-------
* Main pages
    - ``index.php``
    - ``analysis.php``
    - ``download.php``
    - ``result.php`` (show network construction result)

* Methods pages
    - ``Genenet.php``
    - ``ns.php``
    - ``lasso.php``
    - ``glassosf.php``
    - ``pcacmi.php``
    - ``cmi2ni.php``
    - ``space.php``
    - ``eglasso.php``
    - ``espace.php``

* Function pages
    - ``submitjob.php`` (check parameter and data, submit to server)
    - ``waiting.php`` (waiting page when job is submitted)

* Element
    - ``header.php``
    - ``footer.php``
    - ``methods-bar.php`` (dynamically generate left method navlist)
    - ``methods-form.php`` (dynamically generate method parameter form)
    - ``demonetwork.php`` (echart to draw demo network)
    - ``resultnetwork.php`` (echart to draw constructed network)
