Node Label
Text on a line creates a node with the text as the label

Hello
World
an img
Node ID, Classes, Attributes
ID's
Unique text value to identify a node

Hello #x
World #y
Classes
Use classes to group nodes

Cat .animals
Dog .animals
Attributes
Store any data associated to a node

Hello #x.color_blue[letters=5]
World #y.color_red[letters=5]
Edges
Creating an edge between two nodes is done by indenting the second node below the first

Hello
  World
an img
Edge Label
Text followed by colon+space creates an edge with the text as the label

Hello
  to the: World
an img
Edge ID, Classes, Attributes
Edges can also have ID's, classes, and attributes before the label

Hello
  #x to the: World
References
References are used to create edges between nodes that are created elsewhere in the document

Reference by Label
Referencing a node by its exact label

Hello
  World
    (Hello)
an img
Reference by ID
Referencing a node by its unique ID

Hello #x
  World #y
    (#x)
an img
Reference by Class
Referencing multiple nodes with the same assigned class

Cat .animals
Dog .animals
Animals
  (.animals)
an img
Leading References
Draw an edge from multiple nodes by beginning the line with a reference

Cat .animals
Dog .animals

(.animals)
  are pets
an img
Containers
Containers are nodes that contain other nodes. They are declared using curly braces.

Solar System {
  Earth
    Mars
}
an img
Style Classes
The best way to change styles is to right-click on a node or an edge and select the style you want.

Node Colors
Colors include red, orange, yellow, blue, purple, black, white, and gray.

Hello .color_red
  World .color_blue
an img
Node Shapes
The possible shapes are: rectangle, roundrectangle, ellipse, triangle, pentagon, hexagon, heptagon, octagon, star, barrel, diamond, vee, rhomboid, right-rhomboid, polygon, tag, round-rectangle, cut-rectangle, bottom-round-rectangle, and concave-hexagon

Hello .shape_diamond
  World .shape_ellipse
an img
Edge Style
Edges can be styled with dashed, dotted, or solid lines

Hello
  .line_dashed to the: world
    .line_dotted: (Hello)
an img
Source/Target Arrow Shape
Choose from a variety of arrow shapes for the source and target of an edge. Shapes include triangle, triangle-tee, circle-triangle, triangle-cross, triangle-backcurve, vee, tee, square, circle, diamond, chevron, none. .

a
.source-triangle: b
  .source-circle.target-circle: c
    .target-chevron: (a)
an img
Node Border Style
Nodes can be styled with dashed, dotted, or double. Borders can also be removed with border_none.

A .border_dashed
B .border_dotted
C .border_double
D .border_none
an img
Special Attributes
Certain attributes can be used to customize the appearance or functionality of elements.

Width and Height
Use the attributes w and h to explicitly set the width and height of a node.

👋 [w=50]
👋 [h=50]
👋 [w=50][h=50]
an img
Images
Use the attribute src to set the image of a node. The image will be scaled to fit the node, so you may need to adjust the width and height of the node to get the desired result. Only public images (not blocked by CORS) are supported.

Flowchart Fun [src="https://flowchart.fun/apple-touch-icon.png"][w=90][h=90]
an img
Links
Use the attribute href to set a link on a node that opens in a new tab.

Open Twitter 🐦 [href="https://twitter.com"]
an img

