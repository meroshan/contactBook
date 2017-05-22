<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Form\ContactFormType;
use ContactBookBundle\Model\Address;
use ContactBookBundle\Model\AddressQuery;
use ContactBookBundle\Model\Contact;
use ContactBookBundle\Model\Phone;
use ContactBookBundle\Model\ContactQuery;
use FOS\UserBundle\Propel\UserQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContactController extends Controller
{
    /**
     * @Route("/", name = "dashboard")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $contacts = $user->getContacts(
            $this->getContactQuery()
                ->orderByFirstName('asc')
        );

        $user = $this->getUser();
        $recent_contacts = $user->getContacts(
            $this->getContactQuery()
                 ->orderById('desc')
                 ->setLimit(5)
        );
        return array(
            'contacts' => $contacts,
            'recents' => $recent_contacts
        );
    }

    /**
     * @Route("/contact/create", name="createcontact")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();
        $address = new Address();
        $phone = new Phone();
        $contact->addAddress($address);
        $contact->addPhone($phone);
        $contact->getAddresses($address);
        $contact->getPhones($phone);
        $contact->setUser($this->getUser());

        $form = $this->createForm(
            new ContactFormType(),
            $contact,
            array(
                'action' => $this->generateUrl('createcontact'),
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $contact->save();
            return new RedirectResponse($this->generateUrl('dashboard'));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/contact/edit/{id}", name = "edit_contact")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $contact = $this->getContact($id);
        $form = $this->createForm(
            new ContactFormType(),
            $contact,
            array(
                'action' => $this->generateUrl('edit_contact', array(
                    'id' => $id,
                )),
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $contact->save();
            return new RedirectResponse($this->generateUrl('dashboard', array(
                'id' => $id,
            )));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    protected function getContact($id)
    {
        $contact = $this->getQuery()
            ->findPk($id);
        return $contact;
    }

    protected function getQuery()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $query = ContactQuery::create()
            ->filterById($this->getUser());
        } else {
            $query = ContactQuery::create();
        }
        return $query;
       /* $query = ContactQuery::create();
        return $query;*/
    }

    /**
     * @Route("/contact/{id}/delete", name="deletecontact")
     * @Template()
     */
    public function deleteAction(Request $response, $id)
    {
        $contact = $this->getContactQuery()
            ->findPk($id);
       // $contact->delete();
        $this->addFlash('success', "Your contact has been successfully deleted.");
        return new RedirectResponse($this->generateUrl('dashboard'));
    }

    /**
     * @Route("/contact/{id}" , name = "showcontact")
     * @Template()
     */
    public function showAction(Request $request, $id)
    {
        $contact = ContactQuery::create()
            ->filterByUser($this->getUser())
            ->findPk($id);

        return array(
            'contact' => $contact,
        );
    }

    /**
     * @Route("/search/{search}", name="search_contact")
     * @Template()
     */
    public function searchAction(Request $request, $search)
    {
        $contacts = $this->getContactQuery()
            ->filterByFirstName($search.'%')
            ->orderByFirstName()
            ->find();
        return(array(
            'contacts' => $contacts,
        ));
    }

    protected function getContactQuery()
    {
        return ContactQuery::create()
            ->filterByUser($this->getUser());
    }
}
