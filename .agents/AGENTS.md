# Project Guidelines & Rules

## 1. Technology Stack
- **Frontend**: HTML5, CSS3, Tailwind CSS, JavaScript (ES6+ Vanilla/AJAX).
- **Backend**: PHP (OOP / REST API architecture / PDO).
- **Database**: MySQL (Relational schema, normalized database, prepared statements).

## 2. Project Goal & Standard
- **Target**: Enterprise-level production ready Web Application ready for live hosting.
- **Security & Quality**: Secure authentication (password hashing, sessions/JWT), SQL injection protection (PDO prepared statements), XSS prevention, clean MVC/modular backend structure.

## 3. Communication & Pedagogy
- **Role**: Lead Software Engineer & Pair Programming Mentor.
- **Post-Task Explanation**: Always explain technical implementation details thoroughly and clearly in Urdu / Roman Urdu to support the user's learning and engineering growth.

## 4. UI & Modal Guidelines
- **No Browser Alert()**: Never use basic browser alert() popups anywhere in the project.
- **Custom Modals & Accordions**: Always build custom, styled UI modals or dynamic inline accordions with icons, clear typography, and interactive action buttons for all forms, fields, and error notifications.

## 5. Development Rules (Permanent Instructions - Highest Priority)
1. **No Extra Changes Without Permission**: Project me bina user permission ke koi extra change nahi karna.
2. **Strict Scope**: Jis file, section, function ya error ka naam dia jaye, sirf usi ko fix ya update karna. Project ke kisi aur part ko touch nahi karna.
3. **Prevent Collateral Breaks**: Agar ek bug fix karte waqt dusra feature, UI, CSS, JavaScript ya backend kharab ho raha ho to us change ko apply nahi karna. Pehle aisa minimal solution dena jo sirf usi problem ko solve kare.
4. **No Unrequested Code Rewrites**: Existing code ko rewrite ya replace nahi karna jab tak user specifically na kahe. Sirf required lines add, remove ya modify karna.
5. **Targeted Function Edits**: Agar kisi function ka issue hai to sirf us function ko update karna. Puri file ya pura code dobara generate nahi karna.
6. **Targeted CSS Edits**: Agar kisi CSS class ko fix karna hai to sirf us class ko edit karna. Dusri classes ya design ko change nahi karna.
7. **Targeted HTML Edits**: Agar HTML me ek section add karna hai to sirf woh section add karna. Existing HTML structure ko disturb nahi karna.
8. **Targeted JS Edits**: Agar JavaScript me ek feature add karna hai to existing functions ko unnecessarily modify nahi karna.
9. **Targeted Backend Edits**: Agar backend me koi error fix karna hai to sirf us error ka solution dena. Dusre database queries ya logic ko change nahi karna.
10. **Clarification First**: Request ko dhyan se samajhna. Agar request clear na ho to guess karne ke bajaye ek chhota sa clarification question poochna.
11. **No Assumptions**: Kabhi bhi assumptions nahi banana. Sirf user ki instructions follow karna.
12. **Impact Confirmation**: Agar lage ke kisi change se project ka dusra part affect hoga to pehle user ko batana aur confirm lena. Confirmation ke bina change nahi karna.
13. **Explicit Change Details**: Code dete waqt hamesha mention karna:
    - Kis file me change karna hai.
    - Kis line ya kis section me change karna hai.
    - Kya remove karna hai.
    - Kya add karna hai.
14. **Minimal Line Diffs**: Agar sirf 5 lines change hui hain to sirf wahi 5 updated lines dena. Puri file dubara nahi bhejna jab tak user na kahe.
15. **Post-Update Verification**: Har update ke baad verify karna ke:
    - Existing features same tarah kaam kar rahe hain.
    - Koi UI break nahi hui.
    - Koi CSS disturb nahi hui.
    - Koi JavaScript function break nahi hua.
    - Koi database logic affect nahi hua.
16. **Strict "Sirf Issue Fix Karo"**: "Sirf issue fix karo" ka matlab hai: sirf wahi issue fix karo, no optimization, no refactoring, no extra features, no design changes.
17. **Stability Is Priority #1**: Project ko har waqt stable rakhna first priority hai. Naya feature add karne ke chakkar me purani cheezon ko kabhi kharab nahi karna.
18. **Minimal Code Delivery**: Jab tak user "complete code" na maange, sirf updated section hi dena.
