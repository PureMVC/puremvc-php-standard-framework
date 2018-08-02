<?php
/**
 * PureMVC Port to PHP originally translated by Asbjørn Sloth Tønnesen
 *
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */

/**
 * The interface definition for a PureMVC Proxy.
 *
 * <P>
 * In PureMVC, <code>IProxy</code> implementors assume these responsibilities:</P>
 * <UL>
 * <LI>Implement a common method which returns the name of the Proxy.</LI>
 * </UL>
 * <P>
 * Additionally, <code>IProxy</code>s typically:</P>
 * <UL>
 * <LI>Maintain references to one or more pieces of model data.</LI>
 * <LI>Provide methods for manipulating that data.</LI>
 * <LI>Generate <code>INotifications</code> when their model data changes.</LI>
 * <LI>Expose their name as a <code>public static const</code> called <code>NAME</code>.</LI>
 * <LI>Encapsulate interaction with local or remote services used to fetch and persist model data.</LI>
 * </UL>
 */
interface IProxy
{
    /**
     * Get the Proxy name
     * 
     * @return the Proxy instance name
     */
    public function getProxyName();

    /**
     * Get the data object 
     */
    public function getData();

    /**
     * Set the data object.
     * @param mixed $data
     */
    public function setData($data);

    /**
     * Called when the Model registers a Proxy.
     */
    public function onRegister();

    /**
     * Called when the Model removes a Proxy.
     */
    public function onRemove();
}
