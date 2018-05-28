--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL auto_increment,
  `Username` varchar(255) NOT NULL default '',
  `Password` varchar(255) NOT NULL default '',
  `date_registered` int(11) NOT NULL default '0',
  `Temp_pass` varchar(55) default NULL,
  `Temp_pass_active` tinyint(1) NOT NULL default '0',
  `Email` varchar(255) NOT NULL default '',
  `Active` int(11) NOT NULL default '1',
  `Level_access` int(11) NOT NULL default '2',
  `Random_key` varchar(32) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `date_registered`, `Temp_pass`, `Temp_pass_active`, `Email`, `Active`, `Level_access`, `Random_key`) VALUES
(1, 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 20100420, NULL, 0, 'noreply@ekklesiasoft.com', 1, 1, 'nMpknOQW33bSaehYRDND9j5lXGZZb6gk');

-- --------------------------------------------------------

--
-- Table structure for table `vbsreg`
--

CREATE TABLE IF NOT EXISTS `vbsreg` (
  `id` int(11) NOT NULL auto_increment,
  `familyid` varchar(100) NOT NULL default '',
  `cfname` text NOT NULL,
  `clname` text NOT NULL,
  `group` varchar(100) default NULL,
  `bdmon` varchar(100) default NULL,
  `bdday` varchar(100) default NULL,
  `bdyear` varchar(100) default NULL,
  `grade` varchar(100) default NULL,
  `lang` varchar(100) default NULL,
  `school` varchar(100) default NULL,
  `mname` varchar(100) default NULL,
  `mhphone` varchar(12) default NULL,
  `mcphone` varchar(12) default NULL,
  `fname` varchar(100) default NULL,
  `fhphone` varchar(12) default NULL,
  `fcphone` varchar(12) default NULL,
  `addy1` varchar(100) default NULL,
  `addy2` varchar(100) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `zip` varchar(35) default NULL,
  `email` varchar(100) default NULL,
  `churchyn` varchar(10) default NULL,
  `church` varchar(100) default NULL,
  `conditionyn` varchar(10) default NULL,
  `medfood` varchar(10) default NULL,
  `medmed` varchar(10) default NULL,
  `medallother` varchar(10) default NULL,
  `medlac` varchar(10) default NULL,
  `medadd` varchar(10) default NULL,
  `medasthma` varchar(10) default NULL,
  `medbring` varchar(10) default NULL,
  `medother` varchar(10) default NULL,
  `medfoodtxt` text NOT NULL,
  `medmedtxt` text NOT NULL,
  `medallothertxt` text NOT NULL,
  `medaddtxt` text NOT NULL,
  `medasthmatxt` text NOT NULL,
  `medbringtxt` text NOT NULL,
  `medothertxt` text NOT NULL,
  `hear` text NOT NULL,
  `hear_txt` text NOT NULL,
  `sibling` text,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  FULLTEXT KEY `Hear` (`hear`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vbsreg`
--

